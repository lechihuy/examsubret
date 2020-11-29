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

    public function getMajors(Request $request)
    {
        $deparmentId = $request->query('department_id');
        $department = Department::find($deparmentId);
        $majors = optional($department)->majors ?? [];

        return $majors;
    }

    public function getSubjects(Request $request)
    {
        $deparmentId = $request->query('department_id');
        $department = Department::find($deparmentId);
        $subjects = optional($department)->subjects ?? [];
        
        return $subjects;
    }
}
