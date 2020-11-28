<div class="pagination d-flex align-items-center">
    <span class="d-none d-sm-inline-block">Trang</span>
    <div class="input-group-sm mx-1 d-inline-block">
        <input type="number" min="1" max="{{ $last_page }}" name="page" class="form-control" value="{{ request()->input('page') ?? 1 }}">
    </div>
    <span class="d-none d-sm-inline-block">trong tổng {{ $last_page }}.</span>
    <button type="button" class="btn btn-primary btn-sm btn-go-to-page ml-1" action="{{ request()->fullUrl() }}">Đi</button>
</div>