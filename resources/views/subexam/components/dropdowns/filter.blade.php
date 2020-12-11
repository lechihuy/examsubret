<div class="dropdown d-inline-block">
    @if (isset($filter))
        <a class="btn btn-light btn-sm" href="{{ route('subexams.index') }}" style="margin-right: -8px;">
            <i class="fas fa-sync-alt"></i>
        </a>
    @endif
    <a class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
        <i class="fas fa-filter {{ count($filter) ? 'text-success' : '' }}"></i> <span class="d-none d-sm-inline-block">Lọc</span>
    </a>

    <div class="dropdown-menu dropdown-menu-right shadow"  style="max-height: 300px !important; overflow: auto;">
        <form class="px-4 py-2" style="width: 300px; max-width: 100%;" id="form-filter">   
            <div class="form-group input-group-sm">
                <label class="font-weight-bold">Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="all">Tất cả</option>
                    @foreach ($data['status'] as $key => $value)
                        <option value="{{ $key }}"
                            @if (isset($filter['status']) && $filter['status'] != 'all' && $filter['status'] == $key) selected @endif
                        >{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group input-group-sm">
                <label class="font-weight-bold">Khoa</label>
                <select name="department_id" style="width: 100%;">
                    <option value="all">Tất cả</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}"
                            @if (isset($filter['department_id']) && $filter['department_id'] == $department->id)
                                selected
                            @endif
                        >
                            [{{ $department->code}}] {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group input-group-sm">
                <label class="font-weight-bold">Ngành</label>
                <select name="major_id" style="width: 100%;">
                    <option value="all">Tất cả</option>
                    @foreach($majors as $major)
                        <option value="{{ $major->id }}"
                            @if (isset($filter['major_id']) && $filter['major_id'] == $major->id)
                                selected
                            @endif
                        >
                            [{{ $major->code}}] {{ $major->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group input-group-sm">
                <label class="font-weight-bold">Môn</label>
                <select name="subject_id" style="width: 100%;">
                    <option value="all">Tất cả</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}"
                            @if (isset($filter['subject_id']) && $filter['subject_id'] == $subject->id)
                                selected
                            @endif
                        >
                            [{{ $subject->code}}] {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group input-group-sm">
                <label class="font-weight-bold">Nhóm LHP</label>
                <select name="class" style="width: 100%;">
                    <option value="all">Tất cả</option>
                    @foreach ($classes as $class)
                        <option value="{{ $class }}"
                            @if (isset($filter['class']) && $filter['class'] == $class)
                                selected
                            @endif
                        >{{ $class }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group input-group-sm">
                <label class="font-weight-bold">Năm học</label>
                <select name="year" class="form-control">
                    <option value="all">Tất cả</option>
                    @foreach ($years as $year)
                        <option value="{{ $year }}"
                            @if (isset($filter['year']) && $filter['year'] == $year)
                                selected
                            @endif
                        >{{ $year }} - {{ $year + 1 }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group input-group-sm">
                <label class="font-weight-bold">Học kỳ</label>
                <select name="semester" class="form-control">
                    <option value="all">Tất cả</option>
                    @foreach ($data['semesters'] as $value)
                        <option value="{{ $value }}"
                            @if (isset($filter['semester']) && $filter['semester'] == $key)
                                selected
                            @endif
                        >{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group input-group-sm">
                <label class="font-weight-bold">Kỳ thi</label>
                <select name="exam" class="form-control">
                    <option value="all">Tất cả</option>
                    @foreach ($data['exams'] as $key => $value)
                        <option value="{{ $key }}"
                            @if (isset($filter['exam']) && $filter['exam'] == $key)
                                selected
                            @endif
                        >{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Hình thức thi</label>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input check-all-mc" 
                        value="all" id="form-all" for="exam_forms"
                            @if ((isset($filter['exam_forms']) && $filter['exam_forms'] == 'all')
                            || ! isset($filter['exam_forms']))
                                checked
                            @endif
                        >
                    <label class="custom-control-label pt-1" for="form-all">Tất cả</label>
                </div>
                @php $examForms = explode(',', $filter['exam_forms'] ?? '') @endphp
                @foreach ($data['exam_forms'] as $key => $value)
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input choice" 
                            value="{{ $key }}" id="exam-form-{{ $key }}" for="exam_forms"
                                @if ((isset($filter['exam_forms']) 
                                && ($filter['exam_forms'] == 'all' || in_array($key, $examForms)))
                                || ! isset($filter['exam_forms']))
                                    checked
                                @endif
                            >
                        <label class="custom-control-label pt-1" for="exam-form-{{ $key }}">{{ $value }}</label>
                    </div>
                @endforeach
            </div>

            <div class="form-group input-group-sm">
                <label class="font-weight-bold">Được dùng tài liệu</label>
                <select name="used_material" class="form-control">
                    <option value="all">Tất cả</option>
                    @foreach ($data['used_material'] as $key => $value)
                        <option value="{{ $key }}"
                            @if (isset($filter['used_material']) && $filter['used_material'] != 'all' && $filter['used_material'] == $key)
                                selected
                            @endif
                        >{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group input-group-sm">
                <label class="font-weight-bold">Kèm đáp án</label>
                <select name="has_answer" class="form-control">
                    <option value="all">Tất cả</option>
                    @foreach ($data['has_answer'] as $key => $value)
                        <option value="{{ $key }}"
                            @if (isset($filter['has_answer']) && $filter['has_answer'] != 'all' && $filter['has_answer'] == $key)
                                selected
                            @endif
                        >{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group input-group-sm">
                <label class="font-weight-bold">Kèm thang điểm</label>
                <select name="has_point_ladder" class="form-control">
                    <option value="all">Tất cả</option>
                    @foreach ($data['has_point_ladder'] as $key => $value)
                        <option value="{{ $key }}"
                            @if (isset($filter['has_point_ladder']) && $filter['has_point_ladder'] != 'all' && $filter['has_point_ladder'] == $key)
                                selected
                            @endif
                        >{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group input-group-sm">
                <label class="font-weight-bold">Loại đề thi</label>
                <select name="exam_type" class="form-control">
                    <option value="all">Tất cả</option>
                    @foreach ($data['exam_types'] as $key => $value)
                        <option value="{{ $key }}"
                            @if (isset($filter['exam_type']) && $filter['exam_type'] != 'all' && $filter['exam_type'] == $key)
                                selected
                            @endif
                        >{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            @auth('admin')
                <div class="form-group input-group-sm">
                    <label class="font-weight-bold">Giảng viên</label>
                    <select name="teacher_id" style="width: 100%;">
                        <option value="all">Tất cả</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}"
                                @if (isset($filter['teacher_id']) && $filter['teacher_id'] == $teacher->id)
                                    selected
                                @endif
                            >
                                {{ $teacher->identification() }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endauth

            <div class="form-group input-group-sm">
                <label class="font-weight-bold">Ngày tạo</label>
                <select name="created_at" class="form-control">
                    @php 
                        $createdAtOptions = [
                            'desc' => 'Mới nhất',
                            'asc' => 'Cũ nhất'
                        ]
                    @endphp
                    @foreach ($createdAtOptions as $key => $value)
                        <option value="{{ $key }}"
                            @if (isset($filter['created_at']) && $filter['created_at'] == $key)
                                selected
                            @endif
                        >{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <a href="{{ route('subexams.index') }}" class="btn btn-sm btn-light"><i class="fas fa-sync-alt"></i> Khôi phục</a>
            <button type="button" class="btn btn-sm btn-primary float-right btn-search"><i class="fas fa-search"></i> Tìm kiếm</button>
        </form>
    </div>
</div>
