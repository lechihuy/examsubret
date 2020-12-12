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

@can('export')
    <iframe id="printer" src="{{ route('subexams.print', $filter) }}" class="d-none"></iframe>
@endcan

<main class="container-narrow">
    {{-- Breadcrumb --}}
    @include('components.breadcrumb', ['items' => [
        'subexam.index' => 'Yêu cầu nộp đề thi',
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

    {{-- Table --}}
    @if (count($subexams ?? []) > 0)
    <div class="table-wrapper my-4">
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