<?php

namespace App\Services;

use App\Http\Requests\MahasiswaRequest;
use Illuminate\Http\Request;

interface MahasiswaService
{
    function store (MahasiswaRequest $request) : bool;

    function update (MahasiswaRequest $request) : bool;

    function destroy (Request $request) : bool;
}