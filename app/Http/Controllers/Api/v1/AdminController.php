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

    }
}
