<?php

namespace App\Services;

use App\Http\Requests\RegistrationRequest;
use Illuminate\Http\Request;

interface UserService
{
    function login (string $username_email, string $password, bool $remember) : bool;

    function register (RegistrationRequest $request) : bool;

    function logout (Request $request) : void;

}