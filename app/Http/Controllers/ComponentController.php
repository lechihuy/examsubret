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
     * Handle to load job component
     */
    protected function handleJobComponent(Request $request)
    {
        $data = [];
        $error = false;
        $job = $request->only('department_id', 'major_id', 'subject_id');

        if (! TeacherJob::isValid($job)) { $error = true; }

        if (! $error) {
            $data = [
                'department' => Department::find($job['department_id']),
                'major' => Major::find($job['major_id']),
                'subject' => Subject::find($job['subject_id']),
                'class' => 'item btn-open-modal-edit-job',
                'action' => 'Nhấp để sửa'
            ];
        } 

        return ['error' => $error, 'data' => $data];
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
