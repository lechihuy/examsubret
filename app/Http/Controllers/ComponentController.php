<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Department;
use App\Models\Subject;
use App\Models\Major;

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

        if (Department::where('id', $request->query('department_id'))->doesntExist()
        || Major::where('id', $request->query('major_id'))->doesntExist()
        || Subject::where('id', $request->query('subject_id'))->doesntExist()) {
            $error = true;
        }

        if (! $error) {
            $data = $request->query();
            $data['department'] = Department::select('name')
                ->where('id', $data['department_id'])->first()->name;
            $data['major'] = Major::select('name')
                ->where('id', $data['major_id'])->first()->name;
            $data['subject'] = Subject::select('name')
                ->where('id', $data['subject_id'])->first()->name;
        } 

        return [
            'error' => $error,
            'data' => $data,
        ];
    }

    public function load(Request $request, $view, $handle)
    {
        $handle = $this->{$handle}($request);

        if ($handle['error']) {
            return response()->json([
                'message' => 'Đã có lỗi xảy ra.'
            ], 422);
        }

        return view($view, $handle['data']);
    }
}
