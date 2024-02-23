<?php

namespace App\Http\Services;

use App\Models\Supplier;

class SupplierService extends BaseService
{
    protected $model;
    public function __construct(Supplier $model)
    {
        $this->model = $model;
    }
   
}