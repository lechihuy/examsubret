<div class="card border shadow-sm rounded-0">
    {{-- Header --}}
    <div class="card-header bg-white">
        <span class="font-weight-bold">Cơ bản</span>
    </div>
    {{-- /Header --}}

    {{-- Body --}}
    <div class="card-body pb-0">
        {{-- Status --}}
        @if (isset($subexam))
            <div class="form group input-group-sm mb-3">
                <label class="font-weight-bold">Trạng thái</label>
                <p>
                    @include('subexam.components.columns.status', [
                        'full_context' => true 
                    ]) 
                    @if ($subexam->admin_id)
                        bởi <a class="text-primary">{{ $subexam->admin->identification() }}</a>
                    @endif
                </p>
            </div>
        @endif
        {{-- /Status --}}

        {{-- Department --}}
        <div class="form-group input-group-sm">
            <label class="font-weight-bold">Khoa <span class="text-danger">*</span></label>
            <select name="department_id" style="width: 100%;"
            >
                <option value="">-- Chọn khoa -- </option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}"
                        @if (isset($subexam) && $subexam->department_id == $department->id) 
                            selected
                        @endif
                    >
                        [{{ $department->code}}] {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>
        {{-- /Department --}}

        {{-- Major --}}
        <div class="form-group input-group-sm">
            <label class="font-weight-bold">Ngành <span class="text-danger">*</span></label>
            <select name="major_id" style="width: 100%;">
                @if (isset($majors)) 
                    @foreach ($majors as $major)
                        <option value="{{ $major->id }}"
                            @if ($subexam->major_id == $major->id)
                                selected
                            @endif
                        >{{ $major->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        {{-- /Major --}}
        
        {{-- Subject --}}
        <div class="form-group input-group-sm">
            <label class="font-weight-bold">Học phần <span class="text-danger">*</span></label>
            <select name="subject_id" style="width: 100%;">
                @isset($subjects)) 
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}"
                            @if ($subexam->subject_id == $subject->id)
                                selected
                            @endif
                        >{{ $subject->name }}</option>
                    @endforeach
                @endisset
            </select>
        </div>
        {{-- /Subject --}}

        {{-- School year --}}
        <div class="form-group input-group-sm">
            <label class="font-weight-bold">Năm học <span class="text-danger">*</span></label>
            @isset($subexam)
                <p>{{ $subexam->schoolYear() }}</p>
            @else
                <p>{{ now()->format('Y') . '-' . now()->addYear(1)->format('Y') }}</p>
            @endisset
        </div>
        {{-- /School year --}}

        <div class="row">
            <div class="col col-sm-6">
                {{-- Semester --}}
                @php $semester = $subexam->semester ?? $data['semesters'][0] @endphp
                <div class="form-group input-group-sm">
                    <label class="font-weight-bold d-block">Học kỳ <span class="text-danger">*</span></label>
                    @foreach ($data['semesters'] as $value)
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="semester-{{ $value }}" 
                                name="semester" class="custom-control-input" value="{{ $value }}"
                                @if ($semester == $value) checked @endif>
                            <label class="custom-control-label" for="semester-{{ $value }}" role="button">{{ $value }}</label>
                        </div>
                    @endforeach
                </div>
                {{-- /Semester --}}
            </div>
            <div class="col-12 col-sm-6">
                {{-- Exam --}}
                @php $exam = $subexam->exam ?? array_keys($data['exams'])[0] @endphp
                <div class="form-group input-group-sm">
                    <label class="font-weight-bold d-block">Kỳ thi <span class="text-danger">*</span></label>
                    @foreach ($data['exams'] as $key => $name)
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="exam-{{ $key }}" 
                                name="exam" class="custom-control-input" value="{{ $key }}"
                                @if ($exam == $key) checked @endif>
                            <label class="custom-control-label" for="exam-{{ $key }}" role="button">{{ $name }}</label>
                        </div>
                    @endforeach
                </div>
                {{-- /Exam --}}
            </div>
        </div>

        <div class="row">
            {{-- Class --}}
            <div class="col-12 col-sm-6">
                <div class="form-group input-group-sm">
                    <label class="font-weight-bold">Nhóm lớp học phần <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" list="classes" name="class" value="{{ $subexam->class ?? '' }}">
                    <datalist id="classes">
                        @foreach ($classes as $class)
                            <option value="{{ $class }}">
                        @endforeach
                    </datalist>
                </div>
            </div>
            {{-- /Class --}}

            {{-- Time --}}
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label class="font-weight-bold">Thời gian làm bài <span class="text-danger">*</span></label>
                    <div class="input-group input-group-sm">
                        <input type="number" class="form-control" name="time" min="1" value="{{ $subexam->time ?? '' }}">
                        <div class="input-group-append">
                            <span class="input-group-text">phút</span>
                        </div>
                    </div>
                </div>
            </div>
            {{-- /Time --}}
        </div>

        {{-- Exam times --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col"><strong>Chi tiết nộp đề thi</strong></th>
                    <th style="width: 100px;" class="times-1"><strong>Đợt 1</strong></th>
                    <th style="width: 100px;" class="times-2
                        @empty($subexam->times_2_exam_qty))
                            d-none
                        @endempty
                    "><strong>Đợt 2</strong></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Số lượng đề thi gốc <span class="text-danger">*</span></td>
                    <td class="p-0 mb-0 times-1" style="vertical-align: middle;">
                        <input type="number" min="1" class="form-control rounded-0 border-0" name="times_1_exam_qty"
                            value="{{ $subexam->times_1_exam_qty ?? '' }}">
                    </td>
                    <td class="p-0 mb-0 times-2
                        @empty($subexam->times_2_exam_qty)) d-none @endempty
                    " style="vertical-align: middle;">
                        <input type="number" min="1" class="form-control rounded-0 border-0" name="times_2_exam_qty"
                            value="{{ $subexam->times_2_exam_qty ?? '' }}">
                    </td>
                </tr>
            </tbody>
        </table>
        {{-- /Exam times --}}

        {{-- Exam forms --}}
        <div class="form-group input-group-sm">
            <label class="font-weight-bold">Hình thức thi <span class="text-danger">*</span></label>
            @foreach ($data['exam_forms'] as $key => $value)
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" role="button" for="exam_forms" 
                        value="{{ $key }}" id="form-{{ $key }}"
                            @if (isset($subexam) && in_array($key, $subexam->exam_forms))
                                checked
                            @endif
                        >
                    <label class="custom-control-label" role="button" for="form-{{ $key }}">{{ $value }}</label>
                </div>
            @endforeach
            <textarea class="form-control mt-2" rows="1" name="exam_form_note" placeholder="Chú thích về hình thức thi">{{ $subexam->exam_form_note ?? '' }}</textarea>
        </div>
        {{-- /Exam forms --}}

        {{-- Used material --}}
        @php $usedMaterial = $subexam->used_material ?? $data['used_material'][0] @endphp
        <div class="form-group input-group-sm">
            <label class="font-weight-bold d-block">Được sử dụng tài liệu <span class="text-danger">*</span></label>
            @foreach ($data['used_material'] as $key => $name)
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="used-material-{{ $key }}" 
                    name="used_material" class="custom-control-input" value="{{ $key }}"
                    @if ($usedMaterial == $key) checked @endif>
                <label class="custom-control-label" for="used-material-{{ $key }}" role="button">{{ $name }}</label>
            </div>
            @endforeach
            <textarea class="form-control mt-2 
                @if ((isset($subject) && $subexam->used_material == 0) || ! isset($subject)) d-none @endif
            " name="used_material_note" rows="1" placeholder="Liệt kê các tài liệu được phép sử dụng">{{ $subexam->used_material_note ?? '' }}</textarea>
        </div>
        {{-- /Used material --}}

        <div class="row">
            <div class="col-12 col-sm-6">
                {{-- Has answer --}}
                @php $hasAnswer = $subexam->has_answer ?? $data['has_answer'][0] @endphp
                <div class="form-group input-group-sm">
                    <label class="font-weight-bold d-block">Đề thi có kèm đáp án <span class="text-danger">*</span></label>
                    @foreach ($data['has_answer'] as $key => $label)
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="has-answer-{{ $key }}" 
                            name="has_answer" class="custom-control-input" value="{{ $key }}"
                            @if ($hasAnswer == $key) checked @endif>
                        <label class="custom-control-label" for="has-answer-{{ $key }}" role="button">{{ $label }}</label>
                    </div>
                    @endforeach
                </div>
                {{-- /Has answer --}}
            </div>

            <div class="col-12 col-sm-6">
                {{-- Has point ladder --}}
                @php $hasAnswer = $subexam->has_answer ?? $data['has_point_ladder'][0] @endphp
                <div class="form-group input-group-sm">
                    <label class="font-weight-bold d-block">Đề thi có kèm thang điểm <span class="text-danger">*</span></label>
                    @foreach ($data['has_point_ladder'] as $key => $label)
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="has-point-ladder-{{ $key }}" 
                            name="has_point_ladder" class="custom-control-input" value="{{ $key }}"
                            @if ($hasAnswer == $key) checked @endif>
                        <label class="custom-control-label" for="has-point-ladder-{{ $key }}" role="button">{{ $label }}</label>
                    </div>
                    @endforeach
                </div>
                {{-- /Has point ladder --}}
            </div>
        </div>

        {{-- Exam type --}}
        @php $examType = $subexam->exam_type ?? array_keys($data['exam_types'])[0] @endphp
        <div class="form-group input-group-sm">
            <label class="font-weight-bold d-block">Đề thi thuộc loại <span class="text-danger">*</span></label>
            @foreach ($data['exam_types'] as $key => $label)
            <div class="custom-control custom-radio">
                <input type="radio" id="exam-type-{{ $key }}" 
                    name="exam_type" class="custom-control-input" value="{{ $key }}"
                    @if ($examType == $key) checked @endif>
                <label class="custom-control-label" for="exam-type-{{ $key }}" role="button">{{ $label }}</label>
            </div>
            @endforeach
        </div>
        {{-- /Exam type --}}

    </div>
    {{-- /Body --}}
    
</div>