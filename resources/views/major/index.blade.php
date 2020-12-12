@extends('layouts.master')

@push('metas')
@endpush

@push('styles')
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/index-major.js') }}"></script>
@endpush

@section('title', 'Ngành')

@section('content')
<main class="container-narrow">
    {{-- Breadcrumb --}}
    @include('components.breadcrumb', ['items' => [
        'majors.index' => 'Ngành',
    ]])

    {{-- Header --}}
    <div class="d-flex flex-column flex-sm-row">
        <h3 class="mr-auto">Ngành</h3>

        <div class="ml-0 ml-sm-2 mt-3 mt-sm-0 text-right">
            {{-- Action --}}
            @include('major.components.dropdowns.action')

            {{-- Filter --}}
            @include('major.components.dropdowns.filter', ['filter' => $filter ?? []])

            <a href="{{ route('majors.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tạo
            </a>
        </div> 
    </div>
    {{-- /Header --}}

    {{-- Table --}}
    @if (count($majors ?? []) > 0)
    <div class="table-wrapper my-4">
        <table class="table my-table-striped border bg-white mb-0" style="min-width: 100%; width: {{ $table->widthTable() }}px;">
            <thead>
                @include('major.components.table.label-row', [
                    'position' => 'header'
                ])
            </thead>
            <tbody>
                @foreach ($majors as $key => $major)
                    <tr class="border-bottom">
                        @include('major.components.table.selector')

                        @foreach ($table->columns() as $column)
                            @if ($column['primary'])
                                @include('major.components.table.primary-column', [
                                    'link' => route('majors.edit', $major->id)
                                ])
                            @else
                                @include('major.components.table.column', $column)
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <div class="alert alert-info my-4">
            @if (count($filter ?? []))
                Không có kết quả nào phù hợp.
            @else 
                Hiện tại chưa có khoa nào.
            @endif
        </div>
    @endif
    {{-- /Table --}}

    {{-- Button groups --}}
    <div>
        <div class="float-left">
            @include('components.pagination', [
                'last_page' => $majors->lastPage()
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