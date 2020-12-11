@extends('layouts.master')

@push('metas')
@endpush

@push('styles')
@endpush

@push('scripts')
@endpush

@section('title', 'Duyệt yêu cầu nộp đề thi')

@section('content')
<main class="container-narrow">
    {{-- Breadcrumb --}}
    @include('components.breadcrumb', ['items' => [
        'subexams.index' => 'Yêu cầu nộp đề thi',
        '' => 'Duyệt'
    ]])

    {{-- Header --}}
    <h3 class="d-flex flex-column flex-sm-row">
        <div class="mr-auto">Duyệt yêu cầu nộp đề thi</div>
        <div class="ml-0 ml-sm-2 mt-3 mt-sm-0">
            <a href="{{ route('subexams.index') }}" class="btn btn-light btn-sm float-left float-sm-none">
                <i class="fas fa-reply"></i> Trở về
            </a>
            <div class="dropdown d-inline-block">
                <a class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
                    <i class="fas fa-bolt"></i> <span class="d-none d-sm-inline-block">Hành động</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    @foreach (config('data.subexam_actions') as $action => $label)
                        <a class="dropdown-item btn-action" 
                            has-confirmed="true"
                            action="{{ route('subexams.switch_status', $subexam->id) }}" 
                            method="PUT" data-action="{{ $action }}" role="button">{{ $label }}</a>
                    @endforeach
                </div>
            </div>
        </div>  
        <div class="clearfix"></div>
    </h3>
    {{-- /Header --}}

    {{-- Alert --}}
    <div class="alert d-none mt-3" form="#form-create-subexam"></div>
    {{-- /Alert --}}

    {{-- Form --}}
    <form id="form-create-subexam">
        <div class="row my-4">
            {{-- Left column --}}
            <div class="col-12">
                {{-- Init --}}
                <div class="card border shadow-sm rounded-0">
                    {{-- Header --}}
                    <div class="card-header bg-white">
                        <span class="font-weight-bold">Thông tin chi tiết</span>
                    </div>
                    {{-- /Header --}}

                    {{-- Body --}}
                    <div class="card-body pb-0">
                        <table class="table table-bordered mb-0">
                            {{-- Teacher --}}
                            <tr>
                                <td class="font-weight-bold">Người đăng</td>
                                <td>
                                    @include('subexam.components.columns.teacher')
                                </td>
                            </tr>
                            {{-- /Teacher --}}

                            {{-- Status --}}
                            <tr>
                                <td class="font-weight-bold">Trạng thái</td>
                                <td>
                                    @include('subexam.components.columns.status', [
                                        'full_context' => true 
                                    ])
                                </td>
                            </tr>
                            {{-- /Status --}}

                            {{-- Subject --}}
                            <tr>
                                <td class="font-weight-bold">Môn học</td>
                                <td>
                                    @include('subexam.components.columns.subject')
                                </td>
                            </tr>
                            {{-- /Subject --}}

                            {{-- Department --}}
                            <tr>
                                <td class="font-weight-bold">Khoa</td>
                                <td>
                                    @include('subexam.components.columns.department')
                                </td>
                            </tr>
                            {{-- /Department --}}

                            {{-- Major --}}
                            <tr>
                                <td class="font-weight-bold">Ngành</td>
                                <td>
                                    @include('subexam.components.columns.major')
                                </td>
                            </tr>
                            {{-- /Major --}}

                            {{-- Major --}}
                            <tr>
                                <td class="font-weight-bold">Nhóm LHP</td>
                                <td>
                                    @include('subexam.components.columns.class')
                                </td>
                            </tr>
                            {{-- /Major --}}

                            {{-- Year --}}
                            <tr>
                                <td class="font-weight-bold">Năm học</td>
                                <td>
                                    @include('subexam.components.columns.year')
                                </td>
                            </tr>
                            {{-- /Year --}}

                            {{-- Semester --}}
                            <tr>
                                <td class="font-weight-bold">Học kỳ</td>
                                <td>
                                    @include('subexam.components.columns.semester')
                                </td>
                            </tr>
                            {{-- /Semester --}}

                            {{-- Exam --}}
                            <tr>
                                <td class="font-weight-bold">Kỳ thi</td>
                                <td>
                                    @include('subexam.components.columns.exam')
                                </td>
                            </tr>
                            {{-- /Exam --}}

                            {{-- Time --}}
                            <tr>
                                <td class="font-weight-bold">Thời gian làm bài</td>
                                <td>
                                    @include('subexam.components.columns.time')
                                </td>
                            </tr>
                            {{-- /Time --}}

                            {{-- Used material --}}
                            <tr>
                                <td class="font-weight-bold">Được dùng tài liệu</td>
                                <td>
                                    @include('subexam.components.columns.used-material')
                                </td>
                            </tr>
                            {{-- /Used material --}}

                            {{-- Has answer --}}
                            <tr>
                                <td class="font-weight-bold">Kèm đáp án</td>
                                <td>
                                    @include('subexam.components.columns.has-answer')
                                </td>
                            </tr>
                            {{-- /Has answer --}}

                            {{-- Has point ladder --}}
                            <tr>
                                <td class="font-weight-bold">Kèm thang điểm</td>
                                <td>
                                    @include('subexam.components.columns.has-point-ladder')
                                </td>
                            </tr>
                            {{-- /Has point ladder --}}

                            {{-- Forms --}}
                            <tr>
                                <td class="font-weight-bold">Hình thức thi</td>
                                <td>
                                    @include('subexam.components.columns.exam-forms')
                                </td>
                            </tr>
                            {{-- /Forms --}}

                            {{-- Exam type --}}
                            <tr>
                                <td class="font-weight-bold">Loại đề thi</td>
                                <td>
                                    @include('subexam.components.columns.exam-type')
                                </td>
                            </tr>
                            {{-- /Exam type --}}

                            {{-- Note --}}
                            <tr>
                                <td class="font-weight-bold">Ghi chú</td>
                                <td>
                                    @include('subexam.components.columns.note')
                                </td>
                            </tr>
                            {{-- /Note --}}

                            {{-- Created at --}}
                            <tr>
                                <td class="font-weight-bold">Ngày tạo</td>
                                <td>
                                    @include('subexam.components.columns.created-at')
                                </td>
                            </tr>
                            {{-- /Created at --}}

                            {{-- Updated at --}}
                            <tr>
                                <td class="font-weight-bold">Lần sửa đổi cuối</td>
                                <td>
                                    @include('subexam.components.columns.updated-at')
                                </td>
                            </tr>
                            {{-- /Updated at --}}
                        </table>

                        {{-- Exam times --}}
                        <table class="table table-bordered" style="margin-top: -1px;">
                            <thead>
                                <tr>
                                    <th scope="col"><strong>Chi tiết nộp đề thi</strong></th>
                                    <th style="width: 100px;" class="times-1"><strong>Đợt 1</strong></th>
                                    <th style="width: 100px;" class="times-2
                                        @if (! isset($subexam->times_2_exam_qty))
                                            d-none
                                        @endif
                                    "><strong>Đợt 2</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Số đề <span class="text-danger">*</span></td>
                                    <td>
                                        @include('subexam.components.columns.times-1-exam-qty')
                                    </td>
                                    <td class="@empty($subexam->times_2_exam_qty)) d-none @endempty" style="vertical-align: middle;">
                                        @include('subexam.components.columns.times-2-exam-qty')
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        {{-- /Exam times --}}

                    </div>
                </div>
                {{-- /Init --}}
            </div>
            {{-- /Left column --}}

        </div>
    </form>
    {{-- /Form --}}

    {{-- Alert --}}
    <div class="alert d-none mt-3" form="#form-create-subexam"></div>
    {{-- /Alert --}}

    {{-- Button group --}}
    <div class="mt-3">
        <a href="{{ route('subexams.index') }}" class="btn btn-light btn-sm">
            <i class="fas fa-reply"></i> Trở về
        </a>
        <div class="dropdown d-inline-block float-right">
            <a class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
                <i class="fas fa-bolt"></i> <span class="d-none d-sm-inline-block">Hành động</span>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                @foreach (config('data.subexam_actions') as $action => $label)
                    <a class="dropdown-item btn-action" 
                        has-confirmed="true"
                        action="{{ route('subexams.switch_status', $subexam->id) }}" 
                        method="PUT" data-action="{{ $action }}" role="button">{{ $label }}</a>
                @endforeach
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    {{-- /Button group --}}

    {{-- Modals --}}
    @include('components.modals.confirm')
    @include('components.modals.alert')
    {{-- /Modals --}}
</main>
@endsection