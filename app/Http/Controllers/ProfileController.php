<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfile;
use Illuminate\Support\Facades\Storage;

use App\Models\Department;
use App\Models\Subject;
use App\Models\Major;
use App\Models\Admin;
use App\Models\Teacher;

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
        ];

        return view('profile', $data);
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

        if (isset($data['avatar'])) {
            $oldAvatar = $user->avatar;

            if ($oldAvatar) {
                Storage::disk('public')->delete($oldAvatar);
            }

            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }
        
        // If the user change password, save new password and update last change password time
        if (isset($data['old_password'])) {
            $user->password = bcrypt($data['new_password']);
            $user->updateLastChangePassword();
        }

        $user->log('update_profile');
        $user->save();

        return response()->json([
            'message' => 'Cập nhật hồ sơ thành công.',
            'redirect_to' => route('profile.form'),
        ]);
    }

    public function showProfile($username)
    {

        $user = Admin::where('username', $username)->first();

        if (! $user) {
            $user = Teacher::where('username', $username)->first();
        }

        if (! $user) abort(404);

        return view('profile', [
            'user' => $user,
            'show' => true,
        ]);
    }
}
