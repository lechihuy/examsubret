<?php

namespace App\Http\Middleware;

use Closure;
use App\Exceptions\JWTInValidException;
use App\Exceptions\JWTExpiredException;
use Carbon\Carbon;

class VerifyJWT
{
    protected $user;

    protected $exp;

    protected function isLocked()
    {
        return isset($this->user->is_locked) && $this->user->is_locked == true;
    }

    protected function isOldToken()
    {
        return isset($this->user->last_change_password_at) 
            && $this->exp->lte($this->user->last_change_password_at);
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $auth = auth();

        if (! $request->bearerToken()) {
            throw new JWTInvalidException;
        }

        if (! $auth->check()) {
            throw new JWTInvalidException;
        }

        $this->user = $auth->user();
        $this->exp = Carbon::create(date('Y-m-d H:i:s', $auth->payload()['exp']), config('app.timezone'));
        $this->exp->subMinutes(config('jwt.ttl'));

        if ($this->isLocked() || $this->isOldToken()) {
            $auth->logout();

            throw new JWTExpiredException;
        }

        return $next($request);
    }
}
