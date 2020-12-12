<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreDepartment;
use App\Http\Requests\UpdateDepartment;

use App\Models\Department;

class DepartmentController extends Controller
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
            'name', 'code'
        ]);

        return view('department.index', [
            'table' => Department::table(),
            'departments' => Department::list($filter),
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
        return view('department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartment $request)
    {
        $data = $request->validated();

        current_user()->createDepartment($data);

        return response()->json([
            'message' => 'Tạo khoa mới thành công.',
            'redirect_to' => route('departments.index'),
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
        $department = Department::findOrFail($id);

        return view('department.edit', [
            'department' => $department
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepartment $request, $id)
    {
        $data = $request->validated();

        current_user()->updateDepartment($id, $data);

        return response()->json([
            'message' => 'Sửa khoa thành công.',
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
        Department::findOrFail($id);
        
        current_user()->destroyDepartment($id);

        return response()->json([
            'message' => 'Đã xóa khoa.',
            'redirect_to' => $request->redirect_to ?? 'RELOAD'
        ]);
    }

    /**
     * Remove the resource list from storage.
     */
    public function destroyList(Request $request)
    {
        Department::findOrFail($request->ids);

        current_user()->destroyListDepartment($request->ids);

        return response()->json([
            'message' => 'Đã xóa các khoa.',
            'redirect_to' => 'RELOAD'
        ]);
    }
}
