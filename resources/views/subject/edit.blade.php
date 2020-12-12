@extends('layouts.master')

@push('metas')
@endpush

@push('styles')
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/edit-subject.js') }}"></script>
@endpush

@section('title', 'Sửa học phần')

@section('content')
<main class="container-narrow">
    {{-- Breadcrumb --}}
    @include('components.breadcrumb', ['items' => [
        'subjects.index' => 'Học phần',
        'subjects.edit' => 'Sửa',
    ]])

    {{-- Header --}}
    <h3 class="d-flex flex-column flex-sm-row">
        <div class="mr-auto">Sửa học phần</div>
        <div class="ml-0 ml-sm-2 mt-3 mt-sm-0">
            <a href="{{ route('subjects.index') }}" class="btn btn-light btn-sm float-left float-sm-none">
                <i class="fas fa-reply"></i> Trở về
            </a>
            <button class="btn btn-success btn-sm btn-edit-subject float-right float-sm-none">
                <i class="fas fa-check"></i> Lưu
            </button>
        </div>  
        <div class="clearfix"></div>
    </h3>
    {{-- /Header --}}

    {{-- Alert --}}
    <div class="alert d-none mt-3" form="#form-edit-subject"></div>
    {{-- /Alert --}}

    {{-- Form --}}
    <form action="{{ route('subjects.update', $subject->id) }}" method="POST" id="form-edit-subject">
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
    <div class="alert d-none mt-3" form="#form-edit-subject"></div>
    {{-- /Alert --}}

    {{-- Button group --}}
    <div class="mt-3">
        <a href="{{ route('subjects.index') }}" class="btn btn-light btn-sm float-left float-sm-none">
            <i class="fas fa-reply"></i> Trở về
        </a>
        <a class="btn btn-outline-danger btn-sm btn-action" has-confirmed="true"
            action="{{ route('subjects.destroy', $subject->id)}}" method="DELETE"
            data-redirect_to="{{ route('subjects.index') }}" role="button"
        >
            <i class="fas fa-trash-alt"></i> Xóa
        </a>
        <button class="btn btn-success btn-sm btn-edit-subject float-right">
            <i class="fas fa-check"></i> Lưu
        </button>
        <div class="clearfix"></div>
    </div>
    {{-- /Button group --}}

    {{-- Modals --}}
    @include('components.modals.confirm')
    @include('components.modals.alert')
    {{-- /Modals --}}
</main>
@endsection