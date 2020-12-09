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
            <div class="alert alert-info">
                Trường dữ liệu thời gian có dạng <code>Tháng/Ngày/Năm Giờ:Phút:Giây</code>
            </div>

            <div class="form-group input-group-sm">
                <label class="font-weight-bold">Ngày tạo</label>
                <input type="datetime-local" class="form-control" name="created_at" 
                    value="{{ Carbon\Carbon::parse($subexam->created_at)->format('yy-m-d\TH:i:s') }}">
            </div>
            <div class="form-group input-group-sm mb-0">
                <label class="font-weight-bold d-block">Lần cập nhật cuối</label>
                <code>{{ $subexam->updated_at->format('m/d/Y H:i:s') }}</code>
            </div>
            
        </div>
    </div>
    {{-- /Body --}}
    
</div>