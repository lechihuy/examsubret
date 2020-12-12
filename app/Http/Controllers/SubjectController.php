<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSubject;
use App\Http\Requests\UpdateSubject;

use App\Models\Department;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->only([
            'name', 'code', 'department_id',
        ]);

        return view('subject.index', [
            'table' => Subject::table(),
            'subjects' => Subject::list($filter),
            'departments' => Department::all(),
            'filter' => $filter,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subject.create', [
            'departments' => Department::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubject $request)
    {
        $data = $request->validated();

        current_user()->createSubject($data);

        return response()->json([
            'message' => 'Tạo học phần mới thành công.',
            'redirect_to' => route('subjects.index'),
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
        $subject = Subject::findOrFail($id);

        return view('subject.edit', [
            'subject' => $subject,
            'departments' => Department::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubject $request, $id)
    {
        $data = $request->validated();

        current_user()->updateSubject($id, $data);

        return response()->json([
            'message' => 'Sửa học phần thành công.',
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
        Subject::findOrFail($id);
        
        current_user()->destroySubject($id);

        return response()->json([
            'message' => 'Đã xóa học phần.',
            'redirect_to' => $request->redirect_to ?? 'RELOAD'
        ]);
    }

    /**
     * Remove the resource list from storage.
     */
    public function destroyList(Request $request)
    {
        Subject::findOrFail($request->ids);

        current_user()->destroyListSubject($request->ids);

        return response()->json([
            'message' => 'Đã xóa các học phần.',
            'redirect_to' => 'RELOAD'
        ]);
    }
}
