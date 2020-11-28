<nav id="navbar" class="navbar navbar-lg-expand bg-white border-bottom fixed-top py-1 px-2">
    {{-- Logo --}}
    <a class="navbar-brand text-dark" href="{{ route('admin.home') }}">
        <img src="{{ $admin_logo_url }}" width="30" alt=""> <span class="text-logo">Flipper</span>
    </a>
    {{-- /Logo --}}

    <div class="ml-auto">
        {{-- <button type="button" class="btn btn-light btn-clear-cache" action="https://flipper.vn/admin/cache/clear">
            <i class="fas fa-sync-alt"></i>
        </button>
        <a class="btn btn-outline-primary" href="https://flipper.vn" target="_blank">
            <i class="fas fa-eye"></i>
        </a> --}}

        {{-- Dropdown quick action --}}
        <div class="dropdown show d-inline-block">
            <a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" id="dropdown-quick-acition" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Tạo mới
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-quick-acition">
                <a class="dropdown-item" href="{{ route('admin.products.create') }}">Sản phẩm</a>
                <a class="dropdown-item" href="{{ route('admin.posts.create') }}">Bài viết</a>
                <a class="dropdown-item" href="{{ route('admin.pages.create') }}">Trang</a>
                <a class="dropdown-item" href="{{ route('admin.categories.create') }}">Chuyên mục</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('admin.orders.create') }}">Đơn hàng</a>
                <a class="dropdown-item" href="{{ route('admin.vouchers.create') }}">Mã giảm giá</a>
                <a class="dropdown-item" href="{{ route('admin.users.create') }}">Khách hàng</a>
                <a class="dropdown-item" href="{{ route('admin.admins.create') }}">Thành viên</a>    
            </div>
        </div>
        {{-- /Dropdown quick action --}}

        {{-- Toggle sidebar button --}}
        <button type="button" class="btn btn-light d-lg-none btn-toggle-sidebar">
            <i class="fas fa-bars"></i>
        </button>
        {{-- /Toggle sidebar button --}}
    </div>
</nav>        