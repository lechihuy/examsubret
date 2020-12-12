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
    <script src="{{ asset('js/create-subexam.js') }}"></script>
@endpush

@section('title', 'Tạo yêu cầu nộp đề thi')

@section('content')
<main class="container-narrow">
    {{-- Breadcrumb --}}
    @include('components.breadcrumb', ['items' => [
        'subexams.index' => 'Yêu cầu nộp đề thi',
        'subexams.create' => 'Tạo mới'
    ]])

    {{-- Header --}}
    <h3 class="d-flex flex-column flex-sm-row">
        <div class="mr-auto">Tạo yêu cầu nộp đề thi</div>
        <div class="ml-0 ml-sm-2 mt-3 mt-sm-0">
            <a href="{{ route('subexams.index') }}" class="btn btn-light btn-sm float-left float-sm-none">
                <i class="fas fa-reply"></i> Trở về
            </a>
            <button class="btn btn-success btn-sm btn-create-subexam float-right float-sm-none">
                <i class="fas fa-check"></i> Lưu
            </button>
        </div>  
        <div class="clearfix"></div>
    </h3>
    {{-- /Header --}}

    {{-- Alert --}}
    <div class="alert d-none mt-3" form="#form-create-subexam"></div>
    {{-- /Alert --}}

    {{-- Form --}}
    <form action="{{ route('subexams.store') }}" method="POST" id="form-create-subexam">
        <div class="row my-4">
            {{-- Left column --}}
            <div class="col-12 col-md-8 mb-3 mb-md-0">
                {{-- Init --}}
                @include('subexam.components.forms.init')  
                {{-- /Init --}}
            </div>
            {{-- /Left column --}}

            {{-- Right column --}}
            <div class="col-12 col-md-4 pl-3 pl-md-0">
                {{-- Note --}}
                @include('subexam.components.forms.note')
                {{-- /Note --}}
            </div>
            {{-- /Right column --}}
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
        <button class="btn btn-success btn-sm btn-create-subexam float-right">
            <i class="fas fa-check"></i> Lưu
        </button>
        <div class="clearfix"></div>
    </div>
    {{-- /Button group --}}

    {{-- Modals --}}

    {{-- /Modals --}}
</main>
@endsection