<?php

use App\Models\User;

if(!function_exists('is_admin')) {
    function is_admin() {
        return session()->get("role") === User::ROLE_ADMIN;
    }
}

if(!function_exists('is_mahasiswa')) {
    function is_mahasiswa() {
        return session()->get("role") === User::ROLE_MAHASISWA;
    }
}

if(!function_exists("get_data_mahasiswa")) {
    function get_data_mahasiswa() {
        return session()->get('mahasiswa');
    }
}
