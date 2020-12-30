<aside id="sidebar" class="bg-dark fixed-top d-none d-lg-block pb-2">
    {{-- Profile --}}
    <div class="profile px-2 py-3">
        <div class="media">
            <img src="{{ $user->getAvatar() }}" class="mr-3 rounded-circle" style="width: 50px; height: 50px;">

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
                <a href="{{ route('subexams.index') }}">
                    <i class="fas fa-file-upload"></i> Nộp đề thi
                </a>
            </li>
            <li class="py-2">
                <a href="">
                    <i class="fas fa-file-download"></i> Trả túi bài thi
                </a>
            </li>

            @auth('admin')
                <p class="text-muted text-uppercase mt-3 mb-1">Thiết lập</p>
                <li class="py-2">
                    <a role="button">
                        <i class="fas fa-database"></i> Dữ liệu
                        <i class="fas fa-chevron-down float-right mt-1 icon-toggle"></i>
                    </a>

                    <ul class="pl-3 sub-nav">
                        <li class="pt-2 pb-1">
                            <a href="{{ route('departments.index') }}">
                                <i class="far fa-circle"></i> Khoa
                            </a>
                        </li>
                        <li class="py-1">
                            <a href="{{ route('majors.index') }}">
                                <i class="far fa-circle"></i> Ngành
                            </a>
                        </li>
                        <li class="py-1 pb-0">
                            <a href="{{ route('subjects.index') }}">
                                <i class="far fa-circle"></i> Học phần
                            </a>
                        </li>
                    </ul>
                </li>
            @endauth

            <li class="py-2 mt-2">
                <a href="{{ route('auth.logout') }}">
                    <i class="fas fa-sign-out-alt"></i> Thoát
                </a>
            </li>
        </ul>
    </nav>
    {{-- /Nav list --}}

</aside>    