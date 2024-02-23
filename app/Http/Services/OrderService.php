<?php

namespace App\Http\Services;

use App\Models\Order;

class OrderService extends BaseService
{
    public function __construct(Order $model, CustomerService $customerService)
    {
        $this->model = $model;
        $this->customerService = $customerService;
    }

    public function getAll() {
        return $this->model->with(['customer', 'finishedProduct.unit'])->orderBy('id','desc')->get();
    }

}