<td class="text-center">
    @if ($is_verified)
        <label class="badge badge-success">
            <span class="d-none d-md-inline-block">Đã xác nhận</span>
            <i class="d-md-none fas fa-check"></i>
        </label>
        
    @else
        <label class="badge badge-secondary">
            <span class="d-none d-md-inline-block">Đang xử lý</span>
            <i class="d-md-none fas fa-hourglass-half"></i>
        </label>
    @endif
</td>