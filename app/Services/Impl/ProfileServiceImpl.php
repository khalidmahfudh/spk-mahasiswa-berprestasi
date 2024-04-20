<?php

namespace App\Services\Impl;

use App\Services\ProfileService;
use App\Models\User;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileServiceImpl implements ProfileService

{
    function updateprofile(ProfileRequest $request): bool
    {
        $file = $request->file('file');
        $renameFileName = null;

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return false; 
        }

        if ($file) {
            $renameFileName = rand().$file->getClientOriginalName();
            $file->move('img/profile/', $renameFileName);
            $user->image = $renameFileName;
        }

        try {
            $user->name = $request->name;
            $user->username = $request->username;
            return $user->save();
        } catch (\Exception $e) {
            return false;
        }
    }

    function updatepassword(ProfileRequest $request): bool
    {
        $user = Auth::user();
        $current_password = $request->current_password;
        $new_password = $request->new_password;

        if (!password_verify($current_password, $user->password)) {
            return false;
        } else {
            if ($current_password == $new_password) {
                return false;
            } else {
                
                try {
                    $password_hash = Hash::make($request->new_password);
                    $user->password = $password_hash;
                    return $user->save();
                } catch (\Exception $e) {
                    return false;
                }
            }
        }
    }

}