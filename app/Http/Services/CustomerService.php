<?php

namespace App\Http\Services;
use Carbon\Carbon;

use App\Models\Customer;

class CustomerService extends BaseService
{
    protected $model;
    public function __construct(Customer $model)
    {
        $this->model = $model;
    }
}