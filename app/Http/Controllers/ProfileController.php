<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileAdmin;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin,teacher');
    }

    public function showProfileForm()
    {
        return view('profile.profile', [
            'user' => auth(current_guard())->user()
        ]);
    }

    public function update(UpdateProfileAdmin $request)
    {

    }
}
