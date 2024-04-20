<?php

namespace App\Services;

use App\Http\Requests\UsersRequest;
use Illuminate\Http\Request;

interface UsersService
{
    function store (UsersRequest $request) : bool;

    function update (UsersRequest $request) : bool;

    function destroy (Request $request) : bool;

}