<?php

namespace App\Services\Impl;

use App\Services\UsersService;
use App\Models\User;
use App\Http\Requests\UsersRequest;
use Illuminate\Http\Request;

class UsersServiceImpl implements UsersService

{
    function store(UsersRequest $request): bool
    {
        // Proses store (create)
        $userData = $request->all(); // Mengambil semua data yang dikirimkan melalui permintaan

        $user = User::create($userData); // Membuat pengguna baru dengan data yang diberikan

        if (!$user) {
            return false; // Jika pembuatan pengguna gagal, mengembalikan false
        } else {
            return true; // Jika pembuatan pengguna berhasil, mengembalikan true
        }
    }

    function update(UsersRequest $request): bool
    {
        // Proses update
        $userData = $request->all(); // Mengambil semua data yang dikirimkan melalui permintaan

        $userId = $request->id; // Mengambil userId

        $user = User::findOrFail($userId); // Mencari pengguna berdasarkan ID yang diberikan

        if (!$user) {
            return false; // Jika pengguna tidak ditemukan, mengembalikan false
        }

        $user->update($userData); // Memperbarui data pengguna dengan data yang baru

        return true; // Mengembalikan true jika pembaruan berhasil dilakukan
    }

    function destroy(Request $request): bool
    {
            // Ambil id user
            $userId = $request->id;

            // Hapus user berdasarkan userId
            $user = User::findOrFail($userId);

            if (!$user) {
                return false; // Jika pengguna tidak ditemukan, mengembalikan false
            }

            $user->delete(); // Menghapus data user 

            return true; // Mengembalikan true jika penghapusan berhasil dilakukan

    }
}