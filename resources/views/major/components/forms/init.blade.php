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
            <label class="font-weight-bold">Tên ngành <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" value="{{ $major->name ?? '' }}">
        </div>
        {{-- /Name --}}

        {{-- Code --}}
        <div class="form-group input-group-sm">
            <label class="font-weight-bold">Mã ngành <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="code" value="{{ $major->code ?? '' }}">
        </div>
        {{-- /Code --}}

        {{-- Department --}}
        <div class="form-group input-group-sm">
            <label class="font-weight-bold">Thuộc khoa <span class="text-danger">*</span></label>
            <select name="department_id" style="width: 100%;">
                <option value="">-- Chọn khoa -- </option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}"
                        @if (isset($major) && $major->department_id == $department->id) 
                            selected
                        @endif
                    >
                        [{{ $department->code}}] {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>
        {{-- /Department --}}
        
    </div>
    {{-- /Body --}}
    
</div>  