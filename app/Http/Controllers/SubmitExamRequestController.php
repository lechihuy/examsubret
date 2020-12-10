<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSubmitExamRequest;
use App\Http\Requests\UpdateSubmitExamRequest;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\SubmitExamRequest;
use App\Models\Department;
use App\Models\Teacher;

use App\Exports\SubmitExamRequestsExport;

class SubmitExamRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher,admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->only([
            'status', 'department_id', 'major_id', 'subject_id', 
            'year', 'semester', 'exam', 'forms', 'created_at',
            'teacher_id'
        ]);

        if (! count($filter)) {
            return redirect()->route('subexams.index', ['year' => now()->format('Y')]);
        }

        if (auth('teacher')->check()) {
            $filter['teacher_id'] = current_user()->id;
        }

        if (isset($filter['department_id']) && $filter['department_id'] != 'all') {
            $department = Department::find($filter['department_id']);
            $majors = optional($department)->majors ?? [];
            $subjects = optional($department)->subjects ?? [];
        } else {
            $majors = []; $subjects = [];
        }

        if (auth('admin')->check()) {
            $teachers = Teacher::select(['id', 'username', 'fullname', 'email'])->get();
        } else {
            $teachers = [];
        }

        return view('subexam.index', [
           'subexams' => SubmitExamRequest::list($filter),
           'departments' => Department::all(),
           'years' => SubmitExamRequest::getYearList(),
           'filter' => $filter,
           'majors' => $majors,
           'subjects' => $subjects, 
           'teachers' => $teachers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-subexam', current_user());

        return view('subexam.create', [
            'departments' => Department::all(),
            'data' => SubmitExamRequest::data(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubmitExamRequest $request)
    {
        $data = $request->validated();
        
        current_user()->createSubmitExamRequest($data);

        return response()->json([
            'message' => 'Tạo yêu cầu nộp đề thi thành công.',
            'redirect_to' => route('subexams.create'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subexam = SubmitExamRequest::findOrFail($id);

        $this->authorize('edit-subexam', [$id]);

        $department = Department::find($subexam->department_id);
        $majors = optional($department)->majors ?? [];
        $subjects = optional($department)->subjects ?? [];

        return view('subexam.edit', [
            'subexam' => $subexam,
            'departments' => Department::all(),
            'majors' => $majors,
            'subjects' => $subjects, 
        ]);
    }

    public function show($id)
    {
        $subexam = SubmitExamRequest::findOrFail($id);

        $this->authorize('switch-status-subexam');

        return view('subexam.show', [
            'subexam' => $subexam,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubmitExamRequest $request, $id)
    {
        $data = $request->validated();

        current_user()->updateSubmitExamRequest($id, $data);

        return response()->json([
            'message' => 'Sửa yêu cầu nộp đề thi thành công.',
            'redirect_to' => 'RELOAD',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        SubmitExamRequest::findOrFail($id);
        
        $this->authorize('destroy-subexam', [[$id]]);

        current_user()->destroySubmitExamRequest($id);

        return response()->json([
            'message' => 'Đã xóa yêu cầu nộp đề thi.',
            'redirect_to' => $request->redirect_to ?? 'RELOAD'
        ]);
    }

    /**
     * Remove the resource list from storage.
     */
    public function destroyList(Request $request)
    {
        SubmitExamRequest::findOrFail($request->ids);

        $this->authorize('destroy-subexam', [$request->ids]);

        current_user()->destroyListSubmitExamRequest($request->ids);

        return response()->json([
            'message' => 'Đã xóa các yêu cầu nộp đề thi.',
            'redirect_to' => 'RELOAD'
        ]);
    }

    public function switchStatus(Request $request, $id)
    {
        SubmitExamRequest::findOrFail($id);

        $action = $request->action;

        if (! in_array($action, array_keys(config('data.subexam_actions')))) {
            return response()->json([
                'message' => trans('validation.xss')
            ], 422);
        }

        $this->authorize('switch-status-subexam');
        
        current_user()->switchStatusSubmitExamRequest($action, $id);

        return response()->json([
            'message' => 'Đã thay đổi trạng thái yêu cầu nộp đề thi.',
            'redirect_to' => 'RELOAD'
        ]);
    }

    public function switchStatusList(Request $request)
    {
        SubmitExamRequest::findOrFail($request->ids);

        $action = $request->action;

        if (! in_array($action, array_keys(config('data.subexam_actions')))) {
            return response()->json([
                'message' => trans('validation.xss')
            ], 422);
        }

        $this->authorize('switch-status-subexam');
        
        current_user()->switchStatusListSubmitExamRequest($action, $request->ids);

        return response()->json([
            'message' => 'Đã thay đổi trạng thái các yêu cầu nộp đề thi.',
            'redirect_to' => 'RELOAD'
        ]);
    }

    public function export(Request $request)
    {
        $this->authorize('export');

        $filter = $request->only([
            'status', 'department_id', 'major_id', 'subject_id', 
            'year', 'semester', 'exam', 'forms', 'created_at',
            'teacher_id'
        ]);

        if (! count($filter)) {
            $filter = ['year' => now()->format('Y')];
        }

        return Excel::download(new SubmitExamRequestsExport($filter), 'subexams.xlsx');
    }

    public function print(Request $request)
    {
        $this->authorize('export');

        $filter = $request->only([
            'status', 'department_id', 'major_id', 'subject_id', 
            'year', 'semester', 'exam', 'forms', 'created_at',
            'teacher_id'
        ]);

        if (! count($filter)) {
            $filter = ['year' => now()->format('Y')];
        }

        return view('prints.subexams', [
            'subexams' => SubmitExamRequest::list($filter),
        ]);
    }
}
