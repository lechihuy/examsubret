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
            <label class="font-weight-bold">Tên học phần</label>
            <input type="text" class="form-control" name="name" value="{{ $filter['name'] ?? '' }}">
        </div>

        <div class="form-group input-group-sm">
            <label class="font-weight-bold">Mã học phần</label>
            <input type="text" class="form-control" name="code" value="{{ $filter['code'] ?? '' }}">
        </div>

        <div class="form-group input-group-sm">
            <label class="font-weight-bold">Thuộc khoa</label>
            <select name="department_id" style="width: 100%;">
                <option value="all">Tất cả</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}"
                        @if (isset($filter['department_id']) && $filter['department_id'] == $department->id)
                            selected
                        @endif
                    >
                        [{{ $department->code}}] {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <a href="{{ route('subjects.index') }}" class="btn btn-sm btn-light"><i class="fas fa-sync-alt"></i> Khôi phục</a>
        <button type="button" class="btn btn-sm btn-primary float-right btn-search"><i class="fas fa-search"></i> Tìm kiếm</button>
    </form>
</div>
