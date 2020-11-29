@extends('layouts.master')

@push('metas')
@endpush

@push('styles')
@endpush

@push('scripts')
    <script src="{{ asset('js/profile.js') }}"></script>
@endpush

@section('title', 'Hồ sơ')

@section('content')
<main class="container-narrow">
    {{-- Breadcrumb --}}
    @include('components.breadcrumb', ['items' => [
        'profile.form' => 'Hồ sơ'
    ]])

    {{-- Header --}}
    <h3 class="d-flex flex-column flex-sm-row">
        <div class="mr-auto">Hồ sơ</div>
        <div class="ml-0 ml-sm-2 mt-3 mt-sm-0">
            <button class="btn btn-success btn-sm btn-update-profile float-right float-sm-none">
                <i class="fas fa-check"></i> Lưu
            </button>
        </div>  
        <div class="clearfix"></div>
    </h3>
    {{-- /Header --}}

    {{-- Alert --}}
    <div class="alert d-none mt-3" form="#form-update-profile"></div>
    {{-- /Alert --}}

    {{-- Form --}}
    <form action="{{ route('profile.update') }}" method="POST" id="form-update-profile">
        <div class="row my-4">
            {{-- Left column --}}
            <div class="col-12 col-md-8 mb-3 mb-md-0">
                {{-- Init --}}
                <div class="card border shadow-sm rounded-0">

                    {{-- Header --}}
                    <div class="card-header bg-white">
                        <span class="font-weight-bold">Cơ bản</span>
                    </div>
                    {{-- /Header --}}

                    {{-- Body --}}
                    <div class="card-body pb-0">

                        {{-- Username --}}
                        <div class="form-group input-group-sm">
                            <label class="font-weight-bold">Tên đăng nhập</label>
                            <input type="text" class="form-control" value="{{ $user->username }}" disabled>
                        </div>
                        {{-- /Username --}}

                        {{-- Email --}}
                        <div class="form-group input-group-sm">
                            <label class="font-weight-bold">Địa chỉ email</label>
                            <input type="text" class="form-control" value="{{ $user->email }}" disabled>
                        </div>
                        {{-- /Email --}}

                        {{-- Fullname --}}
                        <div class="form-group input-group-sm">
                            <label class="font-weight-bold">Tên đầy đủ <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="fullname" value="{{ $user->fullname }}">
                        </div>
                        {{-- /Fullname --}}

                        {{-- Phone number --}}
                        <div class="form-group input-group-sm">
                            <label class="font-weight-bold">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone_number" value="{{ $user->phone_number }}">
                        </div>
                        {{-- /Phone number --}}

                        {{-- Jobs --}}
                        <div class="form-group input-group-sm">
                            <label class="font-weight-bold">Công việc <span class="text-danger">*</span></label>
                            <div class="list-components list-group">
                                <a role="button" class="list-group-item list-group-item-action btn-open-modal-form" modal="#modal-edit-job">
                                    <data>
                                        <item class="department" type="value"></item>
                                        <item class="major" type="value"></item>
                                        <item class="subject" type="value"></item>
                                    </data>
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1 text-primary">Gv. môn Kỹ thuật phần mềm</h6>
                                    </div>
                                    <p class="mb-0">
                                        Khoa Công nghệ thông tin - Ngành Công nghệ thông tin
                                    </p>
                                </a>
                            </div>
                            <button type="button" class="btn btn-light btn-sm mt-2">
                                <i class="fas fa-plus"></i> Thêm công việc
                            </button>
                        </div>
                        {{-- /Jobs --}}

                    </div>
                    {{-- /Body --}}
                    
                </div>  
                {{-- /Init --}}
            </div>
            {{-- /Left column --}}

            {{-- Right column --}}
            <div class="col-12 col-md-4 pl-3 pl-md-0">
                {{-- Change password --}}
                <div class="card border shadow-sm rounded-0">
                    <div class="card-header bg-white" data-toggle="collapse" data-target="#collapse-change-password" aria-expanded="true">
                        <span class="font-weight-bold">Đổi mật khẩu
                            <a class="float-right text-dark">
                                <i class="fas fa-chevron-down"></i>
                            </a>
                        </span>
                    </div>

                    <div id="collapse-change-password" class="collapse">
                        <div class="card-body">
                            <div class="form-group input-group-sm">
                                <label class="font-weight-bold d-block">Lần đổi mật khẩu cuối</label>
                                @if ($user->hasChangedPassword())
                                    <code>{{ $user->last_change_password_at }}</code>
                                @else
                                    <i class="text-muted">Chưa thay đổi</i>
                                @endif
                            </div>

                            <div class="form-group input-group-sm">
                                <label class="font-weight-bold d-block">Mật khẩu cũ <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="old_password">
                                @auth('teacher')
                                    <small class="form-text text-muted">Nếu đây là lần đổi mật khẩu đầu tiên, hãy nhập mật khẩu cũ tương ứng với tên đăng nhập của bạn.</small>
                                @endauth
                            </div>

                            <div class="form-group input-group-sm">
                                <label class="font-weight-bold d-block">Mật khẩu mới <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="new_password">
                            </div>

                            <div class="form-group input-group-sm mb-0">
                                <label class="font-weight-bold d-block">Nhập lại mật khẩu mới <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="new_password_confirmation">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- /Change password --}}

            </div>
            {{-- /Right column --}}
        </div>
    </form>
    {{-- /Form --}}

    {{-- Alert --}}
    <div class="alert d-none mt-3" form="#form-update-profile"></div>
    {{-- /Alert --}}

    {{-- Button group --}}
    <div class="mt-3">
        <button class="btn btn-success btn-sm btn-update-profile float-right">
            <i class="fas fa-check"></i> Lưu
        </button>
    </div>
    {{-- /Button group --}}

    {{-- Modals --}}
    @include('profile.components.modals.edit-job')
    {{-- /Modals --}}
</main>
@endsection