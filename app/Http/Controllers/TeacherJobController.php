<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class TeacherJobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin,teacher');
    }

    /**
     * Get the major list of the specify department 
     */
    public function getMajors(Request $request)
    {
        $department = Department::find($request->query('department_id'));
        $majors = optional($department)->majors ?? [];

        return $majors;
    }

    /**
     * Get the subject list of the specify department 
     */
    public function getSubjects(Request $request)
    {
        $department = Department::find($$request->query('department_id'));
        $subjects = optional($department)->subjects ?? [];
        
        return $subjects;
    }
}
