<nav id="navbar" class="navbar navbar-lg-expand bg-white border-bottom fixed-top py-1 px-2">
    {{-- Logo --}}
    <a class="navbar-brand text-dark" href="{{ route('dashboard') }}">
        <img src="{{ asset('images/vlu-icon.png') }}" width="25" alt="" class="d-inline-block">
        <span class="text-dark text-uppercase pt-2 mb-0" style="font-size: 1rem;">Exam SubRet</span>
    </a>
    {{-- /Logo --}}

    <div class="ml-auto">

        {{-- Dropdown quick action --}}
        <div class="dropdown show d-inline-block">
            <a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" id="dropdown-quick-acition" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Tạo mới
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-quick-acition">
                @auth('teacher')
                    <a class="dropdown-item" href="{{ route('subexams.create') }}">Yêu cầu nộp đề thi</a>
                    <a class="dropdown-item" href="">Yêu cầu trả túi bài thi</a>
                @endauth

                @auth('admin')
                    <h6 class="dropdown-header">Dữ liệu</h6>
                    <a class="dropdown-item" href="{{ route('departments.create') }}">Khoa</a>
                    <a class="dropdown-item" href="{{ route('majors.create') }}">Ngành</a>
                    <a class="dropdown-item" href="{{ route('subjects.create') }}">Học phần</a>

                @endauth
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