<?php

if (! function_exists('is_auth')) {
    function is_auth() {
        return auth('admin')->check() || auth('teacher')->check();
    }
}

if (! function_exists('current_guard')) {
    function current_guard() {
        return auth('admin')->check() ? 'admin' : (auth('teacher')->check() ? 'teacher' : null);
    }
}

if (! function_exists('current_auth')) {
    function current_auth() {
        return auth(current_guard());
    }
}

if (! function_exists('current_user')) {
    function current_user() {
        return current_auth()->user();
    }
}