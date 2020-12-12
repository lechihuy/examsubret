@extends('layouts.master')

@push('metas')
@endpush

@push('styles')
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/create-subject.js') }}"></script>
@endpush

@section('title', 'Tạo học phần mới')

@section('content')
<main class="container-narrow">
    {{-- Breadcrumb --}}
    @include('components.breadcrumb', ['items' => [
        'subjects.index' => 'Học phần',
        'subjects.create' => 'Tạo mới',
    ]])

    {{-- Header --}}
    <h3 class="d-flex flex-column flex-sm-row">
        <div class="mr-auto">Tạo học phần mới</div>
        <div class="ml-0 ml-sm-2 mt-3 mt-sm-0">
            <a href="{{ route('subjects.index') }}" class="btn btn-light btn-sm float-left float-sm-none">
                <i class="fas fa-reply"></i> Trở về
            </a>
            <button class="btn btn-success btn-sm btn-create-subject float-right float-sm-none">
                <i class="fas fa-check"></i> Lưu
            </button>
        </div>  
        <div class="clearfix"></div>
    </h3>
    {{-- /Header --}}

    {{-- Alert --}}
    <div class="alert d-none mt-3" form="#form-create-subject"></div>
    {{-- /Alert --}}

    {{-- Form --}}
    <form action="{{ route('subjects.store') }}" method="POST" id="form-create-subject">
        <div class="row my-4">
            {{-- Left column --}}
            <div class="col-12">
                {{-- Init --}}
                @include('subject.components.forms.init')
                {{-- /Init --}}
            </div>
            {{-- /Left column --}}
        </div>
    </form>
    {{-- /Form --}}

    {{-- Alert --}}
    <div class="alert d-none mt-3" form="#form-create-subject"></div>
    {{-- /Alert --}}

    {{-- Button group --}}
    <div class="mt-3">
        <a href="{{ route('subjects.index') }}" class="btn btn-light btn-sm float-left float-sm-none">
            <i class="fas fa-reply"></i> Trở về
        </a>
        <button class="btn btn-success btn-sm btn-create-subject float-right">
            <i class="fas fa-check"></i> Lưu
        </button>
        <div class="clearfix"></div>
    </div>
    {{-- /Button group --}}

    {{-- Modals --}}
  
    {{-- /Modals --}}
</main>
@endsection