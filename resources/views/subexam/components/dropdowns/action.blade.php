<div class="dropdown d-inline-block" id="form-action-subexam">
    <a class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
        <i class="fas fa-bolt"></i> <span class="d-none d-sm-inline-block">Hành động</span>
    </a>

    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item btn-action" has-confirmed="true" 
            action="{{ route('subexams.destroy_list') }}" method="DELETE" role="button">Xóa</a>

        @auth('admin')
            <div class="dropdown-divider"></div>

            <a class="dropdown-item btn-action" has-confirmed="true" 
                action="" method="PUT" data-status="0" role="button">Hủy xác thực</a>

            <a class="dropdown-item btn-action" has-confirmed="true"
                action="" method="PUT" data-status="1" role="button">Xác thực</a>
        @endauth
    </div>
</div>