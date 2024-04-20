<?php

namespace App\Services;

use App\Http\Requests\KriteriaRequest;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

interface KriteriaService
{
    function storeKriteria (KriteriaRequest $request) : bool;

    function updateKriteria (KriteriaRequest $request) : bool;

    function destroyKriteria (Request $request) : bool;

    function updateTopsis (Request $request) : bool;

    function getFilteredKriteriaAHP () : Collection;

    function updateAHP (Request $request) : bool;


}