<?php

namespace App\Services;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;

interface ProfileService
{
    function updateprofile (ProfileRequest $request) : bool;

    function updatepassword (ProfileRequest $request) : bool;

}