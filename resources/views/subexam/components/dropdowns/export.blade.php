<div class="dropdown d-inline-block">
    <a class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown">
        <i class="fas fa-file-export"></i> <span class="d-none d-sm-inline-block">Xuất</span>
    </a>

    <div class="dropdown-menu dropdown-menu-right shadow">
        <a class="dropdown-item" role="button" href="{{ route('subexams.export', $filter) }}">Xuất Excel</a>
        <a class="dropdown-item btn-print" 
            action="{{ route('subexams.print')}}" method="GET" role="button">In trang</a>
    </div>
</div>