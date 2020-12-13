@extends('layouts.master')

@push('metas')
@endpush

@push('scripts')
@endpush

@section('title', 'Dashboard')

@section('content')
<main class="container-narrow">
    @include('components.breadcrumb')

    <h3 class="d-flex flex-column flex-sm-row">
        Dashboard
    </h3>

    @if (! current_user()->hasChangedPassword() || ! current_user()->phone_number || ! current_user()->fullname)
        <div class="alert alert-warning my-3" role="alert">
            <h5 class="alert-heading">Xin dành ít thời gian!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </h5>
            @if (! current_user()->hasChangedPassword())
                <li>Có vẻ như tài khoản này mới được tạo hoặc chưa thay đổi mật khẩu mặc định, điều này khá nguy hiểm.</li>
            @endif
            @if (! current_user()->phone_number || ! current_user()->fullname)
                <li>Có vẻ như tài khoản này chưa cung cấp đầy đủ thông tin cần thiết.</li>
            @endif
            <hr>
            <p class="mb-0">Hãy đến <a href="{{ route('profile.form') }}">hồ sơ cá nhân</a> để cập nhật thông tin.</p>
        </div>
    @endif

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white">
                    <span class="font-weight-bold">Yêu cầu nộp đề thi</span>
                </div>
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3 pr-sm-0">
                            @include('components.counter', [
                                'counter' => $counter['subexam']['all'],
                                'label' => 'tất cả',
                                'icon' => 'fas fa-file-upload',
                                'text_color' => 'dark',
                            ])
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 pl-3 pl-sm-0 px-md-0">
                            @include('components.counter', [
                                'counter' => $counter['subexam']['is_verified'],
                                'label' => 'đã xác nhận',
                                'icon' => 'fas fa-check-circle',
                                'text_color' => 'success',
                            ])
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 pl-3 pr-sm-0 px-md-0">
                            @include('components.counter', [
                                'counter' => $counter['subexam']['pending'],
                                'label' => 'đang xử lý',
                                'icon' => 'fas fa-hourglass-half',
                                'text_color' => 'primary',
                            ])
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 pl-sm-0">
                            @include('components.counter', [
                                'counter' => $counter['subexam']['unread'],
                                'label' => 'chưa xem',
                                'icon' => 'fas fa-eye-slash',
                                'text_color' => 'secondary',
                            ])
                        </div>

                        <div class="col-12">
                            @include('components.process-chart', [
                                'all' => $counter['subexam']['all'],
                                'counters' => [
                                    'is_verified' => [
                                        'count' => $counter['subexam']['is_verified'],
                                        'label' => 'đã xác nhận',
                                        'bg' => 'success',
                                    ],
                                    'pending' => [
                                        'count' => $counter['subexam']['pending'],
                                        'label' => 'đang xử lý',
                                        'bg' => 'primary',
                                    ],
                                    'unread' => [
                                        'count' => $counter['subexam']['unread'],
                                        'label' => 'chưa xem',
                                        'bg' => 'secondary',
                                    ]
                                ]
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @auth('admin')
        <div class="row mt-3">
            <div class="col-4">
                @include('components.counter', [
                    'counter' => $counter['department'],
                    'label' => 'khoa',
                    'icon' => 'fas fa-tags',
                    'text_color' => 'dark',
                    'class' => 'rounded bg-white'
                ])
            </div>
            <div class="col-4">
                @include('components.counter', [
                    'counter' => $counter['major'],
                    'label' => 'ngành',
                    'icon' => 'fas fa-tags',
                    'text_color' => 'dark',
                    'class' => 'rounded bg-white'
                ])
            </div>
            <div class="col-4">
                @include('components.counter', [
                    'counter' => $counter['subject'],
                    'label' => 'học phần',
                    'icon' => 'fas fa-tags',
                    'text_color' => 'dark',
                    'class' => 'rounded bg-white'
                ])
            </div>
        </div>
    @endauth
</main>
@endsection