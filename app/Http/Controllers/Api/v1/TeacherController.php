<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    use Authenticates;

    protected $guard = 'teacher';

    public function __construct()
    {
        auth()->shouldUse($this->guard());
        
        $this->middleware('jwt', ['except' => ['loginOutlook', 'callback']]);
    }
}
