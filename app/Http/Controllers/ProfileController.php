<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfile;

use App\Models\Department;
use App\Models\Subject;
use App\Models\Major;
use App\Models\TeacherJob;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin,teacher');
    }

    public function showProfileForm()
    {
        $data = [
            'user' => auth(current_guard())->user(),
            'departments' => Department::all(),
        ];

        if (auth('teacher')->check()) {
            $data['jobs'] = auth('teacher')->user()->jobs()->with('department', 'major', 'subject')->get();
        }

        return view('profile.profile', $data);
    }

    public function update(UpdateProfile $request)
    {
        $data = $request->validated();

        $user = auth(current_guard())->user();
        $user->fullname = $data['fullname'];
        $user->phone_number = $data['phone_number'];   
        
        if (isset($data['old_password'])) {
            $user->password = bcrypt($data['new_password']);
            $user->updateLastChangePassword();
        }

        $user->log('update_profile');
        $user->save();

        if (auth('teacher')->check()) {
            $user->jobs()->delete();
            
            foreach ($data['jobs'] as $job) {
                $job['teacher_id'] = auth('teacher')->user()->id;
                $job = new TeacherJob($job);
                $job->save();
            }
        }

        return response()->json([
            'message' => 'Cập nhật hồ sơ thành công.',
            'redirect_to' => route('profile.form'),
        ]);
    }
}
