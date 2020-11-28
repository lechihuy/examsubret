<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | VLU</title>
    
    <link rel="shortcut icon" href="{{ asset('images/vlu-icon.png') }}" type="image/x-icon">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('metas')

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>
    @auth('admin')
        @include('layouts.header')
        @include('layouts.sidebar')
    @endauth

    @yield('content')

    @auth('admin')
        @include('layouts.footer')
    @endauth

    <script src="{{ asset('js/core/bootstrap.js') }}"></script>
    @stack('scripts')
</body>
</html>