@php
    $isAdmin = auth('admin')->user()->hasRole('SUPER_ADMIN');
@endphp

<aside id="sidebar" class="bg-dark fixed-top d-none d-lg-block pb-2">
    {{-- Profile --}}
    <div class="profile px-2 py-3">
        <div class="media">
            <img src="{{ asset('images/user.png') }}" class="mr-3 rounded" width="50">
            <div class="media-body">
                <p class="text-white text-truncate mb-0">{{ $profile_admin->username }}</p>
                <span class="badge badge-primary">{{ $profile_admin->roles->first()->label }}</span>
            </div>
        </div>
    </div>
    {{-- /Profile --}}

    {{-- Nav list --}}
    <nav>
        <ul class="list-group px-2">
            <li class="py-2">
                <a href="{{ route('admin.home') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="py-2">
                <a href="{{ route('admin.admins.profile') }}">
                    <i class="fas fa-user"></i> Hồ sơ
                </a>
            </li>

            <p class="text-muted text-uppercase mt-3 mb-1">Nội dung</p>
            <li class="py-2">
                <a href="{{ route('admin.products.index') }}">
                    <i class="fas fa-box"></i> Sản phẩm
                </a>
            </li>
            <li class="py-2">
                <a href="{{ route('admin.posts.index') }}">
                    <i class="fas fa-edit"></i> Bài viết
                </a>
            </li>
            <li class="py-2">
                <a href="{{ route('admin.pages.index') }}">
                    <i class="fas fa-file"></i> Trang
                </a>
            </li>
            <li class="py-2">
                <a href="{{ route('admin.categories.index') }}">
                    <i class="fas fa-tags"></i> Chuyên mục
                </a>
            </li>
            
            <p class="text-muted text-uppercase mt-3 mb-1">Quản lí</p>
            <li class="py-2">
                <a href="{{ route('admin.products.warehouse') }}">
                    <i class="fas fa-box-open"></i> Kho hàng
                    @php 
                        $countOutOfStock = App\Product::countOutOfStock()
                    @endphp 

                    @if ($countOutOfStock)
                        <span class="badge badge-danger float-right mt-1">{{ $countOutOfStock }}</span>
                    @endif
                </a>
            </li>
            <li class="py-2">
                <a href="{{ route('admin.orders.index') }}">
                    <i class="fas fa-clipboard-list"></i> Đơn hàng

                    @php 
                        $countOrder = App\Order::countUnseen()
                    @endphp 

                    @if ($countOrder)
                        <span class="badge badge-danger float-right mt-1">{{ $countOrder }}</span>
                    @endif
                </a>
            </li>
            <li class="py-2">
                <a href="{{ route('admin.vouchers.index') }}">
                    <i class="fas fa-ticket-alt"></i> Mã giảm giá
                </a>
            </li>
            <li class="py-2">
                <a href="{{ route('admin.users.index') }}">
                    <i class="fas fa-address-book"></i> Khách hàng
                </a>
            </li>
            @if ($isAdmin)
                <li class="py-2">
                    <a href="{{ route('admin.admins.index') }}">
                        <i class="fas fa-users"></i> Thành viên
                    </a>
                </li>   
            @endif

            @if ($isAdmin)
            <p class="text-muted text-uppercase mt-3 mb-1">Thiết lập</p>
            <li class="py-2">
                <a href="{{ route('admin.themes.index') }}">
                    <i class="fas fa-palette"></i> Giao diện
                </a>
            </li>
            </li>
            <li class="py-2">
                <a href="{{ route('admin.shop.index') }}">
                    <i class="fas fa-store"></i> Cửa hàng
                </a>
            </li>
            @endif

            <p></p>
            <li class="py-2">
                <a href="{{ route('admin.logout') }}">
                    <i class="fas fa-sign-out-alt"></i> Thoát
                </a>
            </li>
        </ul>
    </nav>
    {{-- /Nav list --}}

</aside>    