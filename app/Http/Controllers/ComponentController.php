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

    protected function handleJobComponent(Request $request)
    {
        $data = [];
        $error = false;
        $job = $request->only('department_id', 'major_id', 'subject_id');

        if (! TeacherJob::isValid($job)) { $error = true; }

        if (! $error) {
            // $data = $request->query();
            // $data['department'] = Department::select('name')
            //     ->where('id', $data['department_id'])->first()->name;
            // $data['major'] = Major::select('name')
            //     ->where('id', $data['major_id'])->first()->name;
            // $data['subject'] = Subject::select('name')
            //     ->where('id', $data['subject_id'])->first()->name;
            $data = [
                'department' => Department::find($job['department_id']),
                'major' => Major::find($job['major_id']),
                'subject' => Subject::find($job['subject_id']),
            ];
        } 

        return ['error' => $error, 'data' => $data];
    }

    public function load(Request $request, $view, $handle)
    {
        $handle = $this->{$handle}($request);

        if ($handle['error']) {
            return response()->json([
                'message' => 'Đã có lỗi xảy ra, vui lòng tải lại trang.'
            ], 422);
        }

        return view($view, $handle['data']);
    }
}
