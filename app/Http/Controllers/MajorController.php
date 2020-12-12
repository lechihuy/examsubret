<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreMajor;
use App\Http\Requests\UpdateMajor;

use App\Models\Department;
use App\Models\Major;

class MajorController extends Controller
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

        return view('major.index', [
            'table' => Major::table(),
            'majors' => Major::list($filter),
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
        return view('major.create', [
            'departments' => Department::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMajor $request)
    {
        $data = $request->validated();

        current_user()->createMajor($data);

        return response()->json([
            'message' => 'Tạo ngành mới thành công.',
            'redirect_to' => route('majors.index'),
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
        $major = Major::findOrFail($id);

        return view('major.edit', [
            'major' => $major,
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
    public function update(UpdateMajor $request, $id)
    {
        $data = $request->validated();

        current_user()->updateMajor($id, $data);

        return response()->json([
            'message' => 'Sửa ngành thành công.',
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
        Major::findOrFail($id);
        
        current_user()->destroyMajor($id);

        return response()->json([
            'message' => 'Đã xóa ngành.',
            'redirect_to' => $request->redirect_to ?? 'RELOAD'
        ]);
    }

    /**
     * Remove the resource list from storage.
     */
    public function destroyList(Request $request)
    {
        Major::findOrFail($request->ids);

        current_user()->destroyListMajor($request->ids);

        return response()->json([
            'message' => 'Đã xóa các ngành.',
            'redirect_to' => 'RELOAD'
        ]);
    }
}
