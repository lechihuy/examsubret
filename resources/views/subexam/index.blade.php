@extends('layouts.master')

@push('metas')
    <meta name="majors" content="{{ route('majors') }}">
    <meta name="subjects" content="{{ route('subjects') }}">
@endpush

@push('styles')
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/create-subexam.js') }}"></script>
@endpush

@section('title', 'Yêu cầu nộp đề thi')

@section('content')
<main class="container-narrow">
    {{-- Breadcrumb --}}
    @include('components.breadcrumb', ['items' => [
        'subexam.index' => 'Yêu cầu nộp đề thi',
    ]])


    {{-- Header --}}
    <h3 class="d-flex flex-column flex-sm-row">
        <div class="mr-auto">Yêu cầu nộp đề thi</div>
        <div class="ml-0 ml-sm-2 mt-3 mt-sm-0 text-right">
            {{-- Action --}}
            @include('subexam.components.dropdowns.action')

            {{-- Filter --}}
            @include('subexam.components.dropdowns.filter', ['filter' => $filter ?? []])

            <a href="{{ route('subexams.create') }}" class="btn btn-primary btn-sm btn-create-page">
                <i class="fas fa-plus"></i> Tạo
            </a>
        </div> 
    </h3>
    {{-- /Header --}}

    {{-- Table --}}
    @if (count($subexams ?? []) > 0)
    <div class="table-wrapper my-4">
        <table class="table my-table-striped border bg-white mb-0" style="width: 1600px;">
            <thead>
                @include('subexam.components.table.label-row', [
                    'position' => 'header'
                ])
            </thead>
            <tbody>
                @foreach ($subexams as $key => $subexam)
                    <tr class="border-bottom">
                        {{-- Selector --}}
                        <td scope="row" class="cell-fixed" style="left: -1px;">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input check-row" 
                                data-id="{{ $subexam->id }}" id="check-row-{{ $subexam->id }}">
                                <label class="custom-control-label" for="check-row-{{ $subexam->id }}"></label>
                            </div>
                        </td>
                        {{-- /Selector --}}

                        {{-- Subject --}}
                        <td class="cell-fixed primary-cell" style="left: 48px;">
                            <div class="d-flex">
                                <a href="">{{ $subexam->subject->name }}</a>

                                {{-- Button toggle --}}
                                <span class="ml-auto d-inline-block d-md-none toggle-cell pl-2" 
                                data-toggle="collapse" data-target="#collapse-cell-{{ $subexam->id }}">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                                {{-- /Button toggle --}}
                            </div>

                            {{-- Data toggle --}}
                            <div class="collapse d-md-none w-100" id="collapse-cell-{{ $subexam->id }}">
                                <table class="table table-borderless table-sm mt-3">

                                </table>

                                {{-- Action --}}
                                <div>
                                    <a class="text-danger btn-modal-confirm" selector="false"
                                        btn-confirm-id="btn-destroy-items" data-item_id="{{ $subexam->id }}" role="button">Xóa</a>
                                </div>
                                {{-- /Action --}}

                            </div>
                            {{-- /Data toggle --}}
                        </td>
                        {{-- /Subject --}}
                        
                        {{-- Year --}}
                        @include('subexam.components.table.is-verified', [
                            'is_verified' => $subexam->is_verified
                        ])
                        {{-- /Year --}}

                        {{-- Year --}}
                        @include('subexam.components.table.year', [
                            'year' => $subexam->created_at->format('Y')
                        ])
                        {{-- /Year --}}

                        {{-- Semester --}}
                        @include('subexam.components.table.semester', [
                            'semester' => $subexam->semester
                        ])
                        {{-- /Semester --}}

                        {{-- Exam --}}
                        @include('subexam.components.table.exam', [
                            'exam' => $subexam->exam
                        ])
                        {{-- /Exam --}}

                        {{-- Time --}}
                        @include('subexam.components.table.time', [
                            'time' => $subexam->time
                        ])
                        {{-- /Time --}}

                        @include('subexam.components.table.times', [
                            'times' => $subexam->times_1
                        ])

                        @include('subexam.components.table.times', [
                            'times' => $subexam->times_2
                        ])
                    
                        @include('subexam.components.table.forms', [
                            'forms' => $subexam->forms
                        ])

                        {{-- Created at --}}
                        @include('subexam.components.table.created-at', [
                            'created_at' => $subexam->created_at->format('d-m-Y H:i:s')
                        ])
                        {{-- /Created at --}}
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
            {{-- Action --}}
            @include('subexam.components.dropdowns.action')

            {{-- Filter --}}
            @include('subexam.components.dropdowns.filter', ['filter' => $filter ?? []])

            <a href="{{ route('subexams.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tạo
            </a>
        </div>  
        <div class="clearfix"></div>
    </div>
    {{-- /Button groups --}}

    {{-- Modals --}}
    @include('components.modals.empty-selected-items')
    @include('components.modals.confirm')
    {{-- /Modals --}}
</main>
@endsection