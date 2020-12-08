<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Department;
use App\Models\Subject;
use App\Models\Major;
use App\Models\TeacherJob;

class ComponentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher,admin');
    }

    /**
     * Load a component
     */
    public function load(Request $request, $view, $handle)
    {
        $handle = $this->{$handle}($request);

        if ($handle['error']) {
            return response()->json([
                'message' => trans('validation.xss')
            ], 422);
        }

        return view($view, $handle['data']);
    }
}
