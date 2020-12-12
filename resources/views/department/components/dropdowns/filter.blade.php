<div class="d-inline-block">
    <a class="btn btn-sm btn-light btn-toggle-overlay" overlay="#overlay-filter">
        <i class="fas fa-filter {{ count($filter) ? 'text-success' : '' }}"></i> <span class="d-none d-sm-inline-block">Lọc</span>
    </a>
</div>

<div id="overlay-filter" class="overlay bg-white shadow text-left px-3 py-2 d-none">
    <div class="text-right">
        <button type="button" class="btn btn-sm btn-light btn-toggle-overlay" overlay="#overlay-filter"><i class="fas fa-times"></i> Đóng</button>
    </div>
    <form class="py-2" id="form-filter">   
        <div class="form-group input-group-sm">
            <label class="font-weight-bold">Tên khoa</label>
            <input type="text" class="form-control" name="name" value="{{ $filter['name'] ?? '' }}">
        </div>

        <div class="form-group input-group-sm">
            <label class="font-weight-bold">Mã khoa</label>
            <input type="text" class="form-control" name="code" value="{{ $filter['code'] ?? '' }}">
        </div>

        <a href="{{ route('departments.index') }}" class="btn btn-sm btn-light"><i class="fas fa-sync-alt"></i> Khôi phục</a>
        <button type="button" class="btn btn-sm btn-primary float-right btn-search"><i class="fas fa-search"></i> Tìm kiếm</button>
    </form>
</div>
