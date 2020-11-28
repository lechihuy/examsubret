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