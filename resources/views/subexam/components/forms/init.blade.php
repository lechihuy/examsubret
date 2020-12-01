<div class="card border shadow-sm rounded-0">
    {{-- Header --}}
    <div class="card-header bg-white">
        <span class="font-weight-bold">Cơ bản</span>
    </div>
    {{-- /Header --}}

    {{-- Body --}}
    <div class="card-body pb-0">
        {{-- Department --}}
        <div class="form-group input-group-sm">
            <label class="font-weight-bold">Khoa <span class="text-danger">*</span></label>
            <select name="department_id" style="width: 100%;"
            >
                <option value="">-- Chọn khoa -- </option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}">
                        [{{ $department->code}}] {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>
        {{-- /Department --}}

        {{-- Major --}}
        <div class="form-group input-group-sm">
            <label class="font-weight-bold">Ngành <span class="text-danger">*</span></label>
            <select name="major_id" style="width: 100%;"></select>
        </div>
        {{-- /Major --}}
        
        {{-- Subject --}}
        <div class="form-group input-group-sm">
            <label class="font-weight-bold">Môn <span class="text-danger">*</span></label>
            <select name="subject_id" style="width: 100%;"></select>
        </div>
        {{-- /Subject --}}

        {{-- Semester --}}
        @php $semester = $semester ?? config('data.semesters')[0] @endphp
        <div class="form-group input-group-sm">
            <label class="font-weight-bold d-block">Học kỳ <span class="text-danger">*</span></label>
            @foreach (config('data.semesters') as $value)
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="semester-{{ $value }}" 
                    name="semester" class="custom-control-input" value="{{ $value }}"
                    @if ($semester == $value) checked @endif>
                <label class="custom-control-label" for="semester-{{ $value }}" role="button">{{ $value }}</label>
            </div>
            @endforeach
        </div>
        {{-- /Semester --}}

        {{-- Exam --}}
        @php $exam = $exam ?? array_keys(config('data.exams'))[0] @endphp
        <div class="form-group input-group-sm">
            <label class="font-weight-bold d-block">Kỳ thi <span class="text-danger">*</span></label>
            @foreach (config('data.exams') as $code => $name)
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="exam-{{ $code }}" 
                    name="exam" class="custom-control-input" value="{{ $code }}"
                    @if ($exam == $code) checked @endif>
                <label class="custom-control-label" for="exam-{{ $code }}" role="button">{{ $name }}</label>
            </div>
            @endforeach
        </div>
        {{-- /Exam --}}

        {{-- Exam turn --}}
        @php $exam_turn = $exam_turn ?? config('data.exam_turns')[0] @endphp
        <div class="form-group input-group-sm">
            <label class="font-weight-bold d-block">Số lần thi <span class="text-danger">*</span></label>
            @foreach (config('data.exam_turns') as $value)
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="exam-turn-{{ $value }}" 
                    name="exam_turn" class="custom-control-input" value="{{ $value }}"
                    @if ($exam_turn == $value) checked @endif>
                <label class="custom-control-label" for="exam-turn-{{ $value }}" role="button">{{ $value }}</label>
            </div>
            @endforeach
        </div>
        {{-- /Exam turn --}}

        {{-- Time --}}
        <div class="form-group">
            <label class="font-weight-bold">Thời lượng thi <span class="text-danger">*</span></label>
            <div class="input-group input-group-sm">
                <input type="number" class="form-control" name="time" min="1">
                <div class="input-group-append">
                    <span class="input-group-text">phút</span>
                </div>
            </div>
        </div>
        {{-- /Time --}}

    </div>
    {{-- /Body --}}
    
</div>