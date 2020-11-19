<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

trait Authenticates
{
    public function login(Request $request) 
    {
        $crendentials = $request->only($this->username(), 'password');

        if (! $token = auth()->attempt($crendentials)) {
            return $this->respondFailedLogin();
        }

        return $this->respondSuccessLogin($token);
    }

    public function username()
    {
        return 'username';
    }

    public function guard()
    {
        return $this->guard ?? null;
    }

    public function logout()
    {
        auth()->logout();

        return response()->json([
            'message' => 'Logout successfuly.',
            'code' => 200,
        ]);
    }

    public function refresh()
    {
        auth()->refresh();
    }

    public function me($fields)
    {
        return auth()->user()->select($fields)->get();
    }

    protected function respondFailedLogin()
    {
        return response()->json([
            'error' => [
                'message' => 'Username or passsword is incorrect.',
                'code' => 401,
            ]
        ], 401);
    }

    protected function respondSuccessLogin($token)
    {
        return response()->json([
            'message' => 'Login successfuly.',
            'code' => 200,
            'access_token' => $token,
            'data' => $this->me(['id', 'username'])
        ]);
    }
}
