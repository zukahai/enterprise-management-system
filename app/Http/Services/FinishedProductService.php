<?php

namespace App\Http\Services;

use App\Models\FinishedProduct;

class FinishedProductService extends BaseService
{
    public function __construct(FinishedProduct $model)
    {
        parent::__construct($model);
    }
   
    public function getAll() {
        return parent::$model->with('unit')->orderBy('id','desc')->get();
    }

    public function getById($id) {
        return parent::$model->with('unit')->find($id);
    }

}