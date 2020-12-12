@extends('layouts.master')

@push('metas')
@endpush

@push('styles')
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/create-major.js') }}"></script>
@endpush

@section('title', 'Tạo ngành')

@section('content')
<main class="container-narrow">
    {{-- Breadcrumb --}}
    @include('components.breadcrumb', ['items' => [
        'majors.index' => 'Ngành',
        'majors.create' => 'Tạo mới',
    ]])

    {{-- Header --}}
    <h3 class="d-flex flex-column flex-sm-row">
        <div class="mr-auto">Tạo ngành mới</div>
        <div class="ml-0 ml-sm-2 mt-3 mt-sm-0">
            <a href="{{ route('majors.index') }}" class="btn btn-light btn-sm float-left float-sm-none">
                <i class="fas fa-reply"></i> Trở về
            </a>
            <button class="btn btn-success btn-sm btn-create-major float-right float-sm-none">
                <i class="fas fa-check"></i> Lưu
            </button>
        </div>  
        <div class="clearfix"></div>
    </h3>
    {{-- /Header --}}

    {{-- Alert --}}
    <div class="alert d-none mt-3" form="#form-create-major"></div>
    {{-- /Alert --}}

    {{-- Form --}}
    <form action="{{ route('majors.store') }}" method="POST" id="form-create-major">
        <div class="row my-4">
            {{-- Left column --}}
            <div class="col-12">
                {{-- Init --}}
                @include('major.components.forms.init')
                {{-- /Init --}}
            </div>
            {{-- /Left column --}}
        </div>
    </form>
    {{-- /Form --}}

    {{-- Alert --}}
    <div class="alert d-none mt-3" form="#form-create-major"></div>
    {{-- /Alert --}}

    {{-- Button group --}}
    <div class="mt-3">
        <a href="{{ route('majors.index') }}" class="btn btn-light btn-sm float-left float-sm-none">
            <i class="fas fa-reply"></i> Trở về
        </a>
        <button class="btn btn-success btn-sm btn-create-major float-right">
            <i class="fas fa-check"></i> Lưu
        </button>
        <div class="clearfix"></div>
    </div>
    {{-- /Button group --}}

    {{-- Modals --}}
  
    {{-- /Modals --}}
</main>
@endsection