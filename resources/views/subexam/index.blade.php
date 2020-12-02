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
        @dd($subexams)
        <table class="table my-table-striped border bg-white my-4">
            <thead>
                @include('admin.post.components.table.label-row')
            </thead>
            <tbody>
                @foreach ($posts as $key => $post)
                    <tr class="border-bottom">
                        {{-- Selector --}}
                        <td scope="row">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input check-row" 
                                data-id="{{ $post->id }}" id="check-row-{{ $post->id }}">
                                <label class="custom-control-label" for="check-row-{{ $post->id }}"></label>
                            </div>
                        </td>
                        {{-- /Selector --}}

                        {{-- Title --}}
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('admin.posts.edit', $post->id) }}">
                                    {{ $post->title }}</a>

                                {{-- Button toggle --}}
                                <span class="ml-auto d-inline-block d-md-none toggle-cell pl-2" 
                                data-toggle="collapse" data-target="#collapse-cell-{{ $post->id }}">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                                {{-- /Button toggle --}}
                            </div>

                            {{-- Data toggle --}}
                            <div class="collapse d-md-none w-100" id="collapse-cell-{{ $post->id }}">
                                <table class="table table-borderless table-sm mt-3">

                                    {{-- Category --}}
                                    <tr>
                                        <td class="font-weight-bold pl-0 pr-1">Chuyên mục</td>
                                        <td class="pl-1 pr-0">
                                            @include('admin.post.components.table.category-cell', [
                                                'category' => $post->category])
                                        </td>
                                    </tr>
                                    {{-- /Category --}}

                                    {{-- Status --}}
                                    <tr>
                                        <td class="font-weight-bold pl-0 pr-1">Hiển thị</td>
                                        <td class="pl-1 pr-0">
                                            @include('admin.post.components.table.status-cell', [
                                                'status' => $post->status])
                                        </td>
                                    </tr>
                                    {{-- /Status --}}

                                </table>

                                {{-- Action --}}
                                <div>
                                    <a class="text-danger btn-modal-confirm" selector="false"
                                        btn-confirm-id="btn-destroy-items" data-item_id="{{ $post->id }}" role="button">Xóa</a>
                                </div>
                                {{-- /Action --}}

                            </div>
                            {{-- /Data toggle --}}
                        </td>
                        {{-- /Title --}}

                        {{-- Category --}}
                        <td class="d-none d-md-table-cell">
                            @include('admin.post.components.table.category-cell', [
                                'category' => $post->category])
                        </td>
                        {{-- /Category --}}

                        {{-- Status --}}
                        <td class="d-none d-md-table-cell">
                            @include('admin.post.components.table.status-cell', [
                                'status' => $post->status])
                        </td>
                        {{-- /Status --}}

                        @role('SUPER_ADMIN', 'admin')
                            {{-- Poster --}}
                            <td class="d-none d-md-table-cell">
                                @include('admin.post.components.table.poster-cell', [
                                    'poster' => $post->poster
                                ])
                            </td>
                            {{-- /Poster --}}
                        @endrole

                    </tr>
                @endforeach
            </tbody>

            <tfoot>
                @include('admin.post.components.table.label-row')
            </tfoot>
        </table>
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
    {{-- <div>
        <div class="float-left">
            @include('components.pagination', [
                'last_page' => $posts->lastPage()
            ])
        </div>
        <div class="float-right">
            {{-- Action --}}
            {{-- @include('admin.post.components.dropdowns.action') --}}

            {{-- Filter --}}
            {{-- @include('admin.post.components.dropdowns.filter', ['filter' => $filter]) --}}

            {{-- <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm btn-create-post">
                <i class="fas fa-plus"></i> Tạo
            </a>
        </div>  
        <div class="clearfix"></div> --}}
    {{-- </div> --}}
    {{-- /Button groups --}}

    {{-- Modals --}}
    @include('components.modals.empty-selected-items')
    @include('components.modals.confirm')
    {{-- /Modals --}}
</main>
@endsection