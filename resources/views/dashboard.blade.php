@extends('layouts.master')

@push('metas')
@endpush

@push('scripts')
@endpush

@section('title', 'Dashboard')

@section('content')
<main class="container-narrow">
    @include('components.breadcrumb')

    <h3 class="d-flex flex-column flex-sm-row">
        Dashboard
    </h3>
</main>
@endsection