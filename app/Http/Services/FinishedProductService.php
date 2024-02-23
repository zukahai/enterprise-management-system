<?php

namespace App\Http\Services;

use App\Models\FinishedProduct;

class FinishedProductService extends BaseService
{
    protected $model;
    public function __construct(FinishedProduct $model)
    {
        $this->model = $model;
    }
   
    public function getAll() {
        return $this->model->with('unit')->orderBy('id','desc')->get();
    }

    public function getById($id) {
        return $this->model->with('unit')->find($id);
    }

}