<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SubmitExamRequest;
use App\Models\Department;
use App\Models\Major;
use App\Models\Subject;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher,admin');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (auth('teacher')->check()) {
            $submitExamRequestCounter = SubmitExamRequest::counter([
                'teacher_id' => current_user()->id,
            ]);
        } else {
            $submitExamRequestCounter = SubmitExamRequest::counter();
        }

        $counter = [
            'subexam' => $submitExamRequestCounter,
            'department' => Department::count(),
            'major' => Major::count(),
            'subject' => Subject::count(),
        ];

        return view('dashboard', [
            'counter' => $counter
        ]);
    }
}
