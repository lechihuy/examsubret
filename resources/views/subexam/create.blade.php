@extends('layouts.master')

@push('metas')
@endpush

@push('styles')
@endpush

@push('scripts')
    <script src="{{ asset('js/create-subexam.js') }}"></script>
@endpush

@section('title', 'Tạo yêu cầu nộp đề thi')

@section('content')
<main class="container-narrow">
    {{-- Breadcrumb --}}
    @include('components.breadcrumb', ['items' => [
        'subexam.index' => 'Yêu cầu nộp đề thi',
        'subexam.create' => 'Tạo mới'
    ]])

    {{-- Header --}}
    <h3 class="d-flex flex-column flex-sm-row">
        <div class="mr-auto">Tạo yêu cầu nộp đề thi</div>
        <div class="ml-0 ml-sm-2 mt-3 mt-sm-0">
            <a href="{{ route('subexam.index') }}" class="btn btn-light btn-sm float-left float-sm-none">
                <i class="fas fa-reply"></i> Trở về
            </a>
            <button class="btn btn-primary btn-sm btn-create-subexam float-right float-sm-none">
                <i class="fas fa-plus"></i> Tạo
            </button>
        </div>  
        <div class="clearfix"></div>
    </h3>
    {{-- /Header --}}

    {{-- Alert --}}
    <div class="alert d-none mt-3" form="#form-create-subexam"></div>
    {{-- /Alert --}}

    {{-- Form --}}
    <form action="{{ route('subexam.store') }}" method="POST" id="form-create-subexam">
        <div class="row my-4">
            {{-- Left column --}}
            <div class="col-12 col-md-8 mb-3 mb-md-0">
                {{-- Init --}}
                <div class="card border shadow-sm rounded-0">

                    {{-- Header --}}
                    <div class="card-header bg-white">
                        <span class="font-weight-bold">Cơ bản</span>
                    </div>
                    {{-- /Header --}}

                    {{-- Body --}}
                    <div class="card-body pb-0">

                        {{-- Semester --}}
                        @include('subexam.components.forms.semester')
                        {{-- /Semester --}}

                        {{-- Exam --}}
                        @include('subexam.components.forms.exam')
                        {{-- /Exam --}}

                        {{-- Job --}}
                        @include('subexam.components.forms.job', ['jobs' => $jobs])
                        {{-- /Job --}}

                    </div>
                    {{-- /Body --}}
                    
                </div>  
                {{-- /Init --}}

                {{-- Exam times --}}
                @include('subexam.components.forms.exam-times')
                {{-- /Exam times --}}
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
        <a href="{{ route('subexam.index') }}" class="btn btn-light btn-sm">
            <i class="fas fa-reply"></i> Trở về
        </a>
        <button class="btn btn-primary btn-sm btn-create-subexam float-right">
            <i class="fas fa-plus"></i> Tạo
        </button>
        <div class="clearfix"></div>
    </div>
    {{-- /Button group --}}

    {{-- Modals --}}

    {{-- /Modals --}}
</main>
@endsection