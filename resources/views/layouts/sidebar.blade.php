<aside id="sidebar" class="bg-dark fixed-top d-none d-lg-block pb-2">
    {{-- Profile --}}
    <div class="profile px-2 py-3">
        <div class="media">
            <img src="{{ asset('images/user.png') }}" class="mr-3 rounded" width="50">
            <div class="media-body">
                <p class="text-white text-truncate mb-0">{{ auth()->user()->identification() }}</p>
                @if (current_guard() == 'admin')
                    <span class="badge badge-primary">{{ App\Models\Admin::NAME }}</span>
                @else
                    <span class="badge badge-success">{{ App\Models\Teacher::NAME }}</span>
                @endif
            </div>
        </div>
    </div>
    {{-- /Profile --}}

    {{-- Nav list --}}
    <nav>
        <ul class="list-group px-2">
            <li class="py-2">
                <a href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="py-2">
                <a href="{{ route('profile.form') }}">
                    <i class="fas fa-user"></i> Hồ sơ
                </a>
            </li>

            <p class="text-muted text-uppercase mt-3 mb-1">Yêu cầu</p>
            <li class="py-2">
                <a href="">
                    <i class="fas fa-file-upload"></i> Nộp đề thi
                </a>
            </li>
            <li class="py-2">
                <a href="">
                    <i class="fas fa-file-download"></i> Trả túi đề thi
                </a>
            </li>

            <p></p>
            <li class="py-2">
                <a href="{{ route('auth.logout') }}">
                    <i class="fas fa-sign-out-alt"></i> Thoát
                </a>
            </li>
        </ul>
    </nav>
    {{-- /Nav list --}}

</aside>    