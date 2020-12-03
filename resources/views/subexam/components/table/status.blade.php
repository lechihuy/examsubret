@if ($admin_id == null)
    <label class="badge badge-secondary mb-0">
        <i class="far fa-eye-slash"></i>
        <span @if (! isset($full_context)) class="d-none d-md-inline-block" @endif>Chưa xem</span>
    </label>
@elseif ($is_verified == 1)
    <label class="badge badge-success mb-0">
        <i class="fas fa-check"></i>
        <span @if (! isset($full_context)) class="d-none d-md-inline-block" @endif>Đã xác nhận</span>
    </label>
@elseif ($is_verified == 0)
    <label class="badge badge-primary mb-0">
        <i class="fas fa-hourglass-half"></i>
        <span @if (! isset($full_context)) class="d-none d-md-inline-block" @endif>Đang xử lý</span>
    </label>
@endif