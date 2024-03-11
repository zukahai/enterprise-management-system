<?php

namespace App\Http\Services;

use App\Models\Supplier;

class SupplierService extends BaseService
{
    public function __construct(Supplier $model)
    {
        parent::__construct($model);
    }
   
}