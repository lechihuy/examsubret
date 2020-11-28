@extends('layouts.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('title', 'Đăng nhập hệ thống')

@section('content')
<main class="container-fluid">
    <div class="row vh-100 justify-content-center">
        <div id="box-login" class="align-self-center">
            {{-- Logo --}}
            <div class="logo mb-2">
                <a href="" class="d-flex align-items-center justify-content-center">
                    <img src="{{ asset('images/vlu-icon.png') }}" width="50" alt="" class="d-inline-block">
                    <p class="text-dark text-uppercase pt-2" style="font-size: 1.8rem;">Exam SubRet</p>
                </a>
            </div>
            {{-- /Logo --}}

            <p class="text-center mb-4 font-italic">Made with <i class="fas fa-heart text-danger"></i></p>

            {{-- Alert --}}
            @if ($errors->login->count())
            <div class="alert alert-danger" form="#form-login">
                {{ $errors->login->first() }}
            </div>
            @endif
            {{-- /Alert --}}

            {{-- Login form --}}
            <form action="{{ route('auth.login.post') }}" class="bg-white border p-4" method="POST" id="form-login">
                @csrf

                {{-- Username --}}
                <div class="form-group">
                    <label for="username" class="text-small">Tên đăng nhập</label>
                    <input type="text" class="form-control bg-light" name="username" value="{{ old('username') }}" required>
                </div>
                {{-- /Username --}}

                {{-- Password --}}
                <div class="form-group">
                    <label for="password" class="text-small">Mật khẩu</label>
                    <input type="password" class="form-control bg-light" name="password" required>
                </div>
                {{-- /Password --}}

                {{-- Action --}}
                <div class="form-group d-flex mb-0">
                    <button type="submit" class="btn btn-primary btn-block w-100">Đăng nhập</button>
                </div>
                {{-- /Action --}}

                {{-- Outlook --}}
                <p class="text-divider text-muted"><span>Dành cho giảng viên</span></p>

                <a href="{{ route('auth.login.oauth2.redirect') }}" class="btn btn-light btn-block w-100">
                    <img src="{{ asset('images/office-365.png') }}" height="25">
                    <span>Đăng nhập bằng Office 365</span>
                </a>
                {{-- /Outlook --}}

            </form>
            {{-- /Login form --}}

        </div>
    </div>
</main>
@endsection