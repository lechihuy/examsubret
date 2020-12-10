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
                                    @include('subexam.components.table.teacher')
                                </td>
                            </tr>
                            {{-- /Teacher --}}

                            {{-- Status --}}
                            <tr>
                                <td class="font-weight-bold">Trạng thái</td>
                                <td>
                                    @include('subexam.components.table.status', [
                                        'full_context' => true 
                                    ])
                                </td>
                            </tr>
                            {{-- /Status --}}

                            {{-- Subject --}}
                            <tr>
                                <td class="font-weight-bold">Môn học</td>
                                <td>
                                    {{ $subexam->subject->name }}
                                </td>
                            </tr>
                            {{-- /Subject --}}

                            {{-- Department --}}
                            <tr>
                                <td class="font-weight-bold">Khoa</td>
                                <td>
                                    {{ $subexam->department->name }}
                                </td>
                            </tr>
                            {{-- /Department --}}

                            {{-- Major --}}
                            <tr>
                                <td class="font-weight-bold">Ngành</td>
                                <td>
                                    {{ $subexam->major->name }}
                                </td>
                            </tr>
                            {{-- /Major --}}

                            {{-- Year --}}
                            <tr>
                                <td class="font-weight-bold">Năm học</td>
                                <td>
                                    @include('subexam.components.table.year')
                                </td>
                            </tr>
                            {{-- /Year --}}

                            {{-- Semester --}}
                            <tr>
                                <td class="font-weight-bold">Học kỳ</td>
                                <td>
                                    @include('subexam.components.table.semester', [
                                        'semester' => $subexam->semester
                                    ])
                                </td>
                            </tr>
                            {{-- /Semester --}}

                            {{-- Exam --}}
                            <tr>
                                <td class="font-weight-bold">Kỳ thi</td>
                                <td>
                                    @include('subexam.components.table.exam')
                                </td>
                            </tr>
                            {{-- /Exam --}}

                            {{-- Time --}}
                            <tr>
                                <td class="font-weight-bold">Thời lượng</td>
                                <td>
                                    @include('subexam.components.table.time')
                                </td>
                            </tr>
                            {{-- /Time --}}
                            

                            {{-- Forms --}}
                            <tr>
                                <td class="font-weight-bold">Hình thức thi</td>
                                <td>
                                    @include('subexam.components.table.forms')
                                </td>
                            </tr>
                            {{-- /Forms --}}

                            {{-- Note --}}
                            <tr>
                                <td class="font-weight-bold">Ghi chú</td>
                                <td>
                                    @include('subexam.components.table.note', [
                                        'note' => $subexam->note
                                    ])
                                </td>
                            </tr>
                            {{-- /Note --}}

                            {{-- Created at --}}
                            <tr>
                                <td class="font-weight-bold">Ngày tạo</td>
                                <td>
                                    @include('subexam.components.table.created-at')
                                </td>
                            </tr>
                            {{-- /Created at --}}

                            {{-- Updated at --}}
                            <tr>
                                <td class="font-weight-bold">Lần sửa đổi cuối</td>
                                <td>
                                    @include('subexam.components.table.updated-at', [
                                        'updated_at' => $subexam->updated_at
                                    ])
                                </td>
                            </tr>
                            {{-- /Updated at --}}
                        </table>

                        {{-- Exam times --}}
                        <table class="table table-bordered" style="margin-top: -1px;">
                            <thead>
                                <tr>
                                    <th scope="col"><strong>Chi tiết nộp đề thi</strong></th>
                                    <th style="width: 100px;" class="times-1"><strong>Lần 1</strong></th>
                                    <th style="width: 100px;" class="times-2
                                        @if (! isset($subexam->times_2))
                                            d-none
                                        @endif
                                    "><strong>Lần 2</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Số đề gốc <span class="text-danger">*</span></td>
                                    <td>
                                        @if (isset($subexam->times_1))
                                            {{ $subexam->times_1->origin_exam_qty }}
                                        @endif
                                    </td>
                                    <td class="@empty($subexam->times_2)) d-none @endempty" style="vertical-align: middle;">
                                        @if (isset($subexam->times_2))
                                            {{ optional($subexam->times_2)->origin_exam_qty }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Số mã đề <span class="text-danger">*</span></td>
                                    <td>
                                        @if (isset($subexam->times_1))
                                            {{ $subexam->times_1->exam_code_qty }}
                                        @endif
                                    </td>
                                    <td class="@empty($subexam->times_2)) d-none @endempty">
                                        @if (isset($subexam->times_2))
                                            {{ optional($subexam->times_2)->exam_code_qty }}
                                        @endif
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