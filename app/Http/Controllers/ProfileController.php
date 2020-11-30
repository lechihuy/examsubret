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

    /**
     * Show profile page admin or teacher
     */
    public function showProfileForm()
    {
        $data = [
            'user' => current_user(),
            'departments' => Department::all(),
        ];

        if (auth('teacher')->check()) {
            $data['jobs'] = current_user()->detailOfJobs();
        }

        return view('profile.profile', $data);
    }

    /**
     * Update admin or teacher profile
     */
    public function update(UpdateProfile $request)
    {
        $data = $request->validated();

        // Save common data
        $user = current_user();
        $user->fullname = $data['fullname'];
        $user->phone_number = $data['phone_number'];   
        
        // If the user change password, save new password and update last change password time
        if (isset($data['old_password'])) {
            $user->password = bcrypt($data['new_password']);
            $user->updateLastChangePassword();
        }

        $user->log('update_profile');
        $user->save();

        // If the user is a teacher, save that teacher'jobs
        if (auth('teacher')->check()) {
            $user->jobs()->delete();
            
            foreach ($data['jobs'] as $job) {
                current_user()->addJob($job);
            }
        }

        return response()->json([
            'message' => 'Cập nhật hồ sơ thành công.',
            'redirect_to' => route('profile.form'),
        ]);
    }
}
