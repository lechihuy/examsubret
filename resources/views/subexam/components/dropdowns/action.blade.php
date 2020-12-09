<div class="dropdown d-inline-block">
    <a class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
        <i class="fas fa-bolt"></i> <span class="d-none d-sm-inline-block">Hành động</span>
    </a>

    <div class="dropdown-menu dropdown-menu-right shadow">
        @auth('teacher')
            <a class="dropdown-item btn-action" has-confirmed="true" has-selected="true"
                action="{{ route('subexams.destroy_list') }}" method="DELETE" role="button">Xóa yêu cầu</a>
        @endauth
        
        @auth('admin')
            @foreach (config('data.subexam_actions') as $action => $label)
                <a class="dropdown-item btn-action" 
                    has-confirmed="true"
                    has-selected="true"
                    action="{{ route('subexams.switch_status_list') }}" 
                    method="PUT" data-action="{{ $action }}" role="button">{{ $label }}</a>
            @endforeach
        @endauth
    </div>
</div>