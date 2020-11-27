<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname',
        'email',
        'phone_number',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function log($message)
    {
        return AdminActivityLog::create([
            'message' => $message,
            'admin_id' => $this->id,
        ]);
    }

    public function identification()
    {
        return $this->fullname ?? $this->username;
    }

    public function logout()
    {
        $this->log("Quản trị viên {$this->identification()} vừa đăng xuất.");
        auth()->logout();
    }

    public function updateProfile($data)
    {
        if ($data->has('password')) {
            $this->log("Quản trị viên {$this->identification()} vừa đổi mật khẩu.");
            $data->put('last_change_password_at', now());
        }

        $this->log("Quản trị viên {$this->identification()} vừa cập nhật hồ sơ.");
        return $this->update($data->toArray());
    }
}
