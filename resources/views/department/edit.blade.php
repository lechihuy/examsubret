@extends('layouts.master')

@push('metas')
@endpush

@push('styles')
@endpush

@push('scripts')
    <script src="{{ asset('js/edit-department.js') }}"></script>
@endpush

@section('title', 'Sửa khoa')

@section('content')
<main class="container-narrow">
    {{-- Breadcrumb --}}
    @include('components.breadcrumb', ['items' => [
        'departments.index' => 'Khoa',
        'departments.edit' => 'Sửa',
    ]])

    {{-- Header --}}
    <h3 class="d-flex flex-column flex-sm-row">
        <div class="mr-auto">Sửa khoa</div>
        <div class="ml-0 ml-sm-2 mt-3 mt-sm-0">
            <a href="{{ route('departments.index') }}" class="btn btn-light btn-sm float-left float-sm-none">
                <i class="fas fa-reply"></i> Trở về
            </a>
            <button class="btn btn-success btn-sm btn-edit-department float-right float-sm-none">
                <i class="fas fa-check"></i> Lưu
            </button>
        </div>  
        <div class="clearfix"></div>
    </h3>
    {{-- /Header --}}

    {{-- Alert --}}
    <div class="alert d-none mt-3" form="#form-edit-department"></div>
    {{-- /Alert --}}

    {{-- Form --}}
    <form action="{{ route('departments.update', $department->id) }}" method="POST" id="form-edit-department">
        <div class="row my-4">
            {{-- Left column --}}
            <div class="col-12">
                {{-- Init --}}
                @include('department.components.forms.init')
                {{-- /Init --}}
            </div>
            {{-- /Left column --}}
        </div>
    </form>
    {{-- /Form --}}

    {{-- Alert --}}
    <div class="alert d-none mt-3" form="#form-edit-department"></div>
    {{-- /Alert --}}

    {{-- Button group --}}
    <div class="mt-3">
        <a href="{{ route('departments.index') }}" class="btn btn-light btn-sm float-left float-sm-none">
            <i class="fas fa-reply"></i> Trở về
        </a>
        <a class="btn btn-outline-danger btn-sm btn-action" has-confirmed="true"
            action="{{ route('departments.destroy', $department->id)}}" method="DELETE"
            data-redirect_to="{{ route('departments.index') }}" role="button"
        >
            <i class="fas fa-trash-alt"></i> Xóa
        </a>
        <button class="btn btn-success btn-sm btn-edit-department float-right">
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