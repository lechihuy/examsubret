<div class="dropdown d-inline-block mr-2">
    <a class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
        <i class="fas fa-filter {{ count($filter) ? 'text-success' : '' }}"></i> <span class="d-none d-sm-inline-block">Lọc</span>
    </a>

    <div class="dropdown-menu dropdown-menu-right">
        <form class="px-4 py-2" style="width: 300px; max-width: 100%;">   

            <a href="" class="btn btn-sm btn-light"><i class="fas fa-sync-alt"></i> Khôi phục</a>
            <button type="submit" class="btn btn-sm btn-primary float-right"><i class="fas fa-search"></i> Tìm kiếm</button>
        </form>
    </div>
</div>
