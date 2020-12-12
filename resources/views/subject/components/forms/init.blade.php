<div class="card border shadow-sm rounded-0">
    {{-- Header --}}
    <div class="card-header bg-white">
        <span class="font-weight-bold">Cơ bản</span>
    </div>
    {{-- /Header --}}

    {{-- Body --}}
    <div class="card-body pb-0">

        {{-- Name --}}
        <div class="form-group input-group-sm">
            <label class="font-weight-bold">Tên học phần <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" value="{{ $subject->name ?? '' }}">
        </div>
        {{-- /Name --}}

        {{-- Code --}}
        <div class="form-group input-group-sm">
            <label class="font-weight-bold">Mã học phần <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="code" value="{{ $subject->code ?? '' }}">
        </div>
        {{-- /Code --}}

        {{-- Department --}}
        <div class="form-group input-group-sm">
            <label class="font-weight-bold">Thuộc khoa <span class="text-danger">*</span></label>
            <select mt="department_id" style="width: 100%;" multiple="true">
                @foreach($departments as $department)
                    <option value="{{ $department->id }}"
                        @if (isset($subject) && in_array($department->id, $subject->departments->pluck('id')->toArray())) 
                            selected
                        @endif
                    >
                        [{{ $department->code}}] {{ $department->name }}
                    </option>
                @endforeach
            </select>
            <small class="form-text text-muted">Học phần có thể thuộc nhiều khoa.</small>
        </div>
        {{-- /Department --}}
        
    </div>
    {{-- /Body --}}
    
</div>  