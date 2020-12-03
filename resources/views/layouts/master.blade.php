<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <title>@yield('title') | VLU EXAM SUBRET</title>
    
    <link rel="shortcut icon" href="{{ asset('images/vlu-icon.png') }}" type="image/x-icon">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('metas')

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>
    @isauth
        @include('layouts.header')
        @include('layouts.sidebar')
    @endisauth

    @yield('content')

    @isauth('admin', 'teacher')
        @include('layouts.footer')
    @endisauth

    <script src="{{ asset('js/core/bootstrap.js') }}"></script>
    @stack('scripts')
</body>
</html>