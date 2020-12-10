<div class="card border shadow-sm rounded-0 mt-3">

    {{-- Header --}}
    <div class="card-header bg-white" data-toggle="collapse" data-target="#collapse-timestamps" aria-expanded="true">
        <span class="font-weight-bold">Thời gian
            <a class="float-right text-dark">
                <i class="fas fa-chevron-down"></i>
            </a>
        </span>
    </div>
    {{-- /Header --}}

    {{-- Body --}}
    <div id="collapse-timestamps" class="collapse">
        <div class="card-body">
            <div class="form-group input-group-sm">
                <label class="font-weight-bold d-block">Ngày tạo</label>
                <code>{{ $subexam->created_at->format('m/d/Y H:i:s') }}</code>
            </div>
            <div class="form-group input-group-sm mb-0">
                <label class="font-weight-bold d-block">Lần cập nhật cuối</label>
                <code>{{ $subexam->updated_at->format('m/d/Y H:i:s') }}</code>
            </div>
            
        </div>
    </div>
    {{-- /Body --}}
    
</div>