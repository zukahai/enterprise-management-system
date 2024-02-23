<?php

namespace App\Http\Services;

use App\Models\Unit;

class UnitService extends BaseService
{
    public function __construct(Unit $model)
    {
        $this->model = $model;
    }
   
}