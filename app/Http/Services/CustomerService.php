<?php

namespace App\Http\Services;
use Carbon\Carbon;

use App\Models\Customer;

class CustomerService extends BaseService
{
    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }
}