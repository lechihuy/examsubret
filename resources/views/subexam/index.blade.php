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

            @auth('teacher')
                <a href="{{ route('subexams.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tạo
                </a>
            @endauth
        </div> 
    </h3>
    {{-- /Header --}}

    {{-- Table --}}
    @if (count($subexams ?? []) > 0)
    <div class="table-wrapper my-4">
        <table class="table my-table-striped border bg-white mb-0" style="width: 2000px; min-width: 100%;">
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
                                <a href="
                                    @auth('admin')
                                        {{ route('subexams.show', $subexam->id) }}
                                    @elseauth('teacher')
                                        {{ route('subexams.edit', $subexam->id) }}
                                    @endauth
                                ">{{ $subexam->subject->name }}</a>

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
                                    {{-- Status --}}
                                    <tr>
                                        <td class="font-weight-bold pl-0 pr-1 border-0">Trạng thái</td>
                                        <td class="pl-1 pr-0 border-0">
                                            @include('subexam.components.table.status', [
                                                'full_context' => true 
                                            ])
                                        </td>
                                    </tr>
                                    {{-- /Status --}}

                                    {{-- Year --}}
                                    <tr>
                                        <td class="font-weight-bold pl-0 pr-1 border-0">Năm học</td>
                                        <td class="pl-1 pr-0 border-0">
                                            @include('subexam.components.table.year')
                                        </td>
                                    </tr>
                                    {{-- /Year --}}

                                    {{-- Semester --}}
                                    <tr>
                                        <td class="font-weight-bold pl-0 pr-1 border-0">Học kỳ</td>
                                        <td class="pl-1 pr-0 border-0">
                                            @include('subexam.components.table.semester')
                                        </td>
                                    </tr>
                                    {{-- /Semester --}}

                                    {{-- Exam --}}
                                    <tr>
                                        <td class="font-weight-bold pl-0 pr-1 border-0">Kỳ thi</td>
                                        <td class="pl-1 pr-0 border-0">
                                            @include('subexam.components.table.exam')
                                        </td>
                                    </tr>
                                    {{-- /Exam --}}

                                    {{-- Time --}}
                                    <tr>
                                        <td class="font-weight-bold pl-0 pr-1 border-0">Thời lượng</td>
                                        <td class="pl-1 pr-0 border-0">
                                            @include('subexam.components.table.time')
                                        </td>
                                    </tr>
                                    {{-- /Time --}}

                                    {{-- Times 1 --}}
                                    <tr>
                                        <td class="font-weight-bold pl-0 pr-1 border-0">Lần 1</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold pl-0 pr-1 border-0">— Số đề gốc</td>
                                        <td class="pl-1 pr-0 border-0">
                                            @include('subexam.components.table.origin-exam-qty', [
                                                'times' => $subexam->times_1
                                            ])
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold pl-0 pr-1 border-0">— Số mã đề</td>
                                        <td class="pl-1 pr-0 border-0">
                                            @include('subexam.components.table.exam-code-qty', [
                                                'times' => $subexam->times_1
                                            ])
                                        </td>
                                    </tr>
                                    {{-- /Times 1 --}}

                                    {{-- Times 2 --}}
                                    <tr>
                                        <td class="font-weight-bold pl-0 pr-1 border-0">Lần 2</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold pl-0 pr-1 border-0">— Số đề gốc</td>
                                        <td class="pl-1 pr-0 border-0">
                                            @include('subexam.components.table.origin-exam-qty', [
                                                'times' => $subexam->times_2
                                            ])
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold pl-0 pr-1 border-0">— Số mã đề</td>
                                        <td class="pl-1 pr-0 border-0">
                                            @include('subexam.components.table.exam-code-qty', [
                                                'times' => $subexam->times_2
                                            ])
                                        </td>
                                    </tr>
                                    {{-- /Times 2 --}}

                                    {{-- Forms --}}
                                    <tr>
                                        <td class="font-weight-bold pl-0 pr-1 border-0">Hình thức thi</td>
                                        <td class="pl-1 pr-0 border-0">
                                            @include('subexam.components.table.forms')
                                        </td>
                                    </tr>
                                    {{-- /Forms --}}

                                    {{-- Note --}}
                                    <tr>
                                        <td class="font-weight-bold pl-0 pr-1 border-0">Ghi chú</td>
                                        <td class="pl-1 pr-0 border-0">
                                            @include('subexam.components.table.note')
                                        </td>
                                    </tr>
                                    {{-- /Note --}}

                                    @auth('admin')
                                    <tr>
                                        <td class="font-weight-bold pl-0 pr-1 border-0">Người tạo</td>
                                        <td class="pl-1 pr-0 border-0">
                                            @include('subexam.components.table.teacher')
                                        </td>
                                    </tr>
                                    @endauth

                                    {{-- Created at --}}
                                    <tr>
                                        <td class="font-weight-bold pl-0 pr-1 border-0">Ngày tạo</td>
                                        <td class="pl-1 pr-0 border-0">
                                            @include('subexam.components.table.created-at')
                                        </td>
                                    </tr>
                                    {{-- /Created at --}}
                                </table>

                                {{-- Action --}}
                                @auth('teacher')
                                    <div>
                                        <a href="{{ route('subexams.edit', $subexam->id) }}" class="mr-3">Sửa</a>
                                        <a class="text-danger btn-action" has-confirmed="true" 
                                        action="{{ route('subexams.destroy', $subexam->id) }}" method="DELETE" 
                                        data-redirect_to="RELOAD" role="button">Xóa</a>
                                    </div>
                                @endauth
                                {{-- /Action --}}

                            </div>
                            {{-- /Data toggle --}}
                        </td>
                        {{-- /Subject --}}
                        
                        {{-- Status --}}
                        <td class="text-center d-none d-md-table-cell">
                            @include('subexam.components.table.status')
                        </td>
                        {{-- /Status --}}

                        {{-- Year --}}
                        <td class="text-center d-none d-md-table-cell">
                            @include('subexam.components.table.year')
                        </td>
                        {{-- /Year --}}

                        {{-- Semester --}}
                        <td class="text-center d-none d-md-table-cell">
                            @include('subexam.components.table.semester')
                        </td>
                        {{-- /Semester --}}

                        {{-- Exam --}}
                        <td class="text-center d-none d-md-table-cell">
                            @include('subexam.components.table.exam')
                        </td>
                        {{-- /Exam --}}

                        {{-- Time --}}
                        <td class="text-center d-none d-md-table-cell">
                            @include('subexam.components.table.time')
                        </td> 
                        {{-- /Time --}}

                        {{-- Times 1 --}}
                        <td class="text-center d-none d-md-table-cell">
                            @include('subexam.components.table.origin-exam-qty', [
                                'times' => $subexam->times_1
                            ])
                        </td>

                        <td class="text-center d-none d-md-table-cell">
                            @include('subexam.components.table.exam-code-qty', [
                                'times' => $subexam->times_1
                            ])
                        </td>
                        {{-- /Times 1 --}}

                        {{-- Times 2 --}}
                        <td class="text-center d-none d-md-table-cell">
                            @include('subexam.components.table.origin-exam-qty', [
                                'times' => $subexam->times_2
                            ])
                        </td>

                        <td class="text-center d-none d-md-table-cell">
                            @include('subexam.components.table.exam-code-qty', [
                                'times' => $subexam->times_2
                            ])
                        </td>
                        {{-- /Times 2 --}}

                        {{-- Forms --}}
                        <td class="text-center d-none d-md-table-cell">
                            @include('subexam.components.table.forms')
                        </td>
                        {{-- /Forms --}}

                        {{-- Note --}}
                        <td class="text-center d-none d-md-table-cell">
                            @include('subexam.components.table.note')
                        </td>
                        {{-- /Note --}}

                        {{-- Teacher --}}
                        @auth('admin')
                            <td class="text-center d-none d-md-table-cell">
                                @include('subexam.components.table.teacher')
                            </td>
                        @endauth
                        {{-- /Teacher --}}

                        {{-- Created at --}}
                        <td class="text-center d-none d-md-table-cell">
                            @include('subexam.components.table.created-at')
                        </td>
                        {{-- /Created at --}}
                    </tr>
                @endforeach
            </tbody>

            <tfoot>
                @include('subexam.components.table.label-row', [
                    'position' => 'footer'
                ])
            </tfoot>
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