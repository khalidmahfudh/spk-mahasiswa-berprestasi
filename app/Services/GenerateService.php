<?php

namespace App\Services;

use Illuminate\Http\Request;

interface GenerateService
{
    function processTopsis(): array;

    function processAhp(): array;

}