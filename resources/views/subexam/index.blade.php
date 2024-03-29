@extends('layouts.master')

@push('metas')
    <meta name="data.majors" content="{{ route('data.majors') }}">
    <meta name="data.subjects" content="{{ route('data.subjects') }}">
@endpush

@push('styles')
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/index-subexam.js') }}"></script>
@endpush

@section('title', 'Yêu cầu nộp đề thi')

@section('content')

<main class="container-narrow">
    {{-- Breadcrumb --}}
    @include('components.breadcrumb', ['items' => [
        'subexams.index' => 'Yêu cầu nộp đề thi',
    ]])

    {{-- Header --}}
    <div class="d-flex flex-column flex-sm-row">
        <h3 class="mr-auto">Yêu cầu nộp đề thi</h3>

        <div class="ml-0 ml-sm-2 mt-3 mt-sm-0 text-right">
            {{-- Action --}}
            @include('subexam.components.dropdowns.action')

            {{-- Filter --}}
            @include('subexam.components.dropdowns.filter', ['filter' => $filter ?? []])

            @auth('teacher')
                <a href="{{ route('subexams.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tạo
                </a>
            @endauth
        </div> 
    </div>
    {{-- /Header --}}

    {{-- Search --}}
    <div class="input-group input-group-sm mt-3">
        <input type="text" placeholder="Nhập tên học phần để tìm kiếm..." class="form-control" action="{{ request()->fullUrl() }}" name="k" value="{{ $filter['k'] ?? '' }}">
        <div class="input-group-append">
            <button class="btn btn-primary btn-search" action="{{ request()->fullUrl() }}" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    {{-- /Search --}}

    @can('export')
    <div class="mt-4 py-2 d-flex justify-content-between align-items-start" id="save-selected-item-switcher" style="margin-bottom: -1px;">
        <div class="custom-control custom-switch mr-2">
            <input type="checkbox" class="custom-control-input" id="save-selected-item-mode">
            <label class="custom-control-label" for="save-selected-item-mode">Chế độ lưu phần tử để xuất (khi thao tác với nhiều trang)</label>
        </div>
        <span class="label-counter badge badge-primary">Đã chọn <span class="counter">0</span></span>
    </div>
    @endcan

    {{-- Table --}}
    @if (count($subexams ?? []) > 0)
    <div class="table-wrapper @cannot('export') mt-4 @endcannot mb-4">
        <table class="table my-table-striped border bg-white mb-0" style="min-width: 100%; width: {{ $table->widthTable() }}px;">
            <thead>
                @include('subexam.components.table.label-row', [
                    'position' => 'header'
                ])
            </thead>
            <tbody>
                @foreach ($subexams as $key => $subexam)
                    <tr class="border-bottom">
                        @include('subexam.components.table.selector')

                        @foreach ($table->columns() as $column)
                            @if ($column['primary'])
                                @include('subexam.components.table.primary-column', [
                                    'link' => auth('admin')->check() 
                                                ? route('subexams.show', $subexam->id) 
                                                : route('subexams.edit', $subexam->id)
                                ])
                            @else
                                @include('subexam.components.table.column', $column)
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <div class="alert alert-info my-4">
            @if (count($filter ?? []))
                Không có kết quả nào phù hợp.
            @else 
                Hiện tại chưa có yêu cầu nộp đề thi nào.
            @endif
        </div>
    @endif
    {{-- /Table --}}

    {{-- Button groups --}}
    <div>
        <div class="float-left">
            @include('components.pagination', [
                'last_page' => $subexams->lastPage()
            ])
        </div>
        <div class="float-right">
            @can('export')
                @include('subexam.components.dropdowns.export')
            @endcan
        </div>  
        <div class="clearfix"></div>
    </div>
    {{-- /Button groups --}}

    {{-- Modals --}}
    @include('components.modals.empty-selected-items')
    @include('components.modals.confirm')
    @include('components.modals.alert')
    {{-- /Modals --}}
</main>
@endsection