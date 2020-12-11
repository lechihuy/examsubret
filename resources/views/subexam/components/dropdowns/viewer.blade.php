<div class="dropdown d-inline-block">
    <a class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
        <i class="fas fa-eye"></i> <span class="d-none d-sm-inline-block">Chế độ xem</span>
    </a>

    <div class="dropdown-menu dropdown-menu-right shadow"  style="max-height: 300px !important; overflow: auto;">
        <form class="px-4 py-2" style="width: 300px; max-width: 100%;" id="form-viewer">   
            <div class="form-group input-group-sm">
                <label class="font-weight-bold">Số hàng trên trang</label>
                <input type="number" name="item_per_page" class="form-control" min="1">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="no-page" name="no_page" role="button">
                    <label class="custom-control-label" for="no-page" role="button">Không phân trang</label>
                </div>
            </div>

            <div class="form-group input-group-sm">
                <label class="font-weight-bold">Cột hiển thị</label>
                @foreach($table->columns() as $name => $column)
                    @if ($column['is_visible'])
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="column-{{ $name }}" name="column_{{ $name }}" role="button">
                            <label class="custom-control-label" for="column-{{ $name }}" role="button">{{ ucfirst($column['label']) }}</label>
                        </div>
                    @endif
                @endforeach
            </div>


            <a href="" class="btn btn-sm btn-light"><i class="fas fa-sync-alt"></i> Mặc định</a>
            <button type="button" class="btn btn-sm btn-primary float-right btn-apply"><i class="fas fa-check"></i> Áp dụng</button>
        </form>
    </div>
</div>
