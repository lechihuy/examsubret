<div class="card border shadow-sm rounded-0 mt-3">
    {{-- Header --}}
    <div class="card-header bg-white">
        <span class="font-weight-bold">Chi tiết lần thi</span>
    </div>
    {{-- /Header --}}

    {{-- Body --}}
    <div class="card-body pb-0">
        <div class="row">
            {{-- Times --}}
            <div class="col-12 col-sm-4">
                <div class="form-group input-group-sm">
                    <label class="font-weight-bold">Lần thi <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="times">
                    <small class="form-text text-muted">Lần thi chỉ hỗ trợ định dạng số.</small>
                </div>
            </div>
            {{-- /Times --}}

            {{-- Test quantity --}}
            <div class="col-12 col-sm-4">
                <div class="form-group input-group-sm">
                    <label class="font-weight-bold">Số lượng đề thi <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="test_quantity" min="1">
                </div>
            </div>
            {{-- /Test quantity --}}

            {{-- Time --}}
            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <label class="font-weight-bold">Thời lượng thi <span class="text-danger">*</span></label>
                    <div class="input-group input-group-sm">
                        <input type="number" class="form-control" name="time" min="1">
                        <div class="input-group-append">
                            <span class="input-group-text">phút</span>
                        </div>
                    </div>
                </div>
            </div>
            {{-- /Time --}}
        </div>
    </div>
    {{-- /Body --}}
</div>