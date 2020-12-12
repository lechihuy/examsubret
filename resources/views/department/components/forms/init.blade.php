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
            <label class="font-weight-bold">Tên khoa <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" value="{{ $department->name ?? '' }}">
        </div>
        {{-- /Name --}}

        {{-- Code --}}
        <div class="form-group input-group-sm">
            <label class="font-weight-bold">Mã khoa <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="code" value="{{ $department->code ?? '' }}">
        </div>
        {{-- /Code --}}
        
    </div>
    {{-- /Body --}}
    
</div>  