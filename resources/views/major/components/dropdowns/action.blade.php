<div class="dropdown d-inline-block">
    <a class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
        <i class="fas fa-bolt"></i> <span class="d-none d-sm-inline-block">Hành động</span>
    </a>

    <div class="dropdown-menu dropdown-menu-right shadow">
        <a class="dropdown-item btn-action" has-confirmed="true" has-selected="true"
            action="{{ route('majors.destroy_list') }}" method="DELETE" role="button">Xóa ngành</a>
    </div>
</div>