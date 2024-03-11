<?php

namespace App\Http\Services;

use App\Models\Order;

class OrderService extends BaseService
{
    public function __construct(Order $model, CustomerService $customerService)
    {
        parent::__construct($model);
        $this->customerService = $customerService;
    }

    public function getAll() {
        return parent::$model->with(['customer', 'finishedProduct.unit'])->orderBy('id','desc')->get();
    }

}