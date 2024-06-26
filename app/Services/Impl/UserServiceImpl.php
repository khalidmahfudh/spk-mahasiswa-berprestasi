<?php

namespace App\Services\Impl;

use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Http\Request;


class UserServiceImpl implements UserService

{
    function login(string $username_email, string $password, bool $remember): bool
    {

        $input = $username_email;
    
        $field = filter_var($input, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Cari pengguna berdasarkan email
        $user = User::where($field, $input)->first();

        // Cek apakah pengguna ditemukan dan apakah pengguna tersebut aktif
        if (!$user || $user->is_active !== 1) {
            return false; // Mengembalikan false jika pengguna tidak ditemukan atau tidak aktif
        }

        $credentials = [
            $field => $input,
            'password' => $password
        ];

        if (Auth::attempt($credentials, $remember)) {
            return true; // Mengembalikan true jika otentikasi berhasil
        } else {
            return false; // Mengembalikan false jika otentikasi gagal
        }
    }

    function register(RegistrationRequest $request): bool
    {
        
        $userData = $request->all();

        $user = User::create($userData);

        if (!$user) {
            return false; 
        } else {
            return true; 
        }

    }

    function logout(Request $request): void
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}