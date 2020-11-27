<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\UpdateProfileAdmin;

class AdminController extends Controller
{
    use Authenticates;

    protected $guard = 'admin';

    public function __construct()
    {
        auth()->shouldUse($this->guard());
        
        $this->middleware('jwt', ['except' => 'login']);
    }

    public function updateProfile(UpdateProfileAdmin $request)
    {
        $data = collect($request->validated());

        if ($data->has('old_password')) {
            $data->put('password', bcrypt($data->get('new_password')));
            $data->pull('old_password');
            $response = $this->refresh('Cập nhật thông tin hồ sơ thành công.');
        }  else {
            $response = response()->json([
                'code' => 200,
                'message' => 'Cập nhật thông tin hồ sơ thành công.',
            ]);
        }

        $data->pull('new_password');

        auth()->user()->updateProfile($data);

        return $response;
    }
}
