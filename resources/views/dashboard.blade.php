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
</main>
@endsection