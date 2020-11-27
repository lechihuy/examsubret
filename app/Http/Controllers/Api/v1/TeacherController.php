<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\UpdateProfileTeacher;

class TeacherController extends Controller
{
    use Authenticates;

    protected $guard = 'teacher';

    public function __construct()
    {
        auth()->shouldUse($this->guard());
        
        $this->middleware('jwt:teacher')->only('logout', 'refresh', 'me', 'updateProfile');
    }

    public function updateProfile(UpdateProfileTeacher $request)
    {
        $data = collect($request->validated());

        auth()->user()->updateProfile($data);

        return response()->json([
            'code' => 200,
            'message' => 'Cập nhật thông tin hồ sơ thành công.',
        ]);
    }
}
