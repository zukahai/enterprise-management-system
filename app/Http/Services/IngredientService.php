<?php

namespace App\Http\Services;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Ingredient;

class IngredientService extends BaseService
{
    public function __construct(Ingredient $model)
    {
        parent::__construct($model);
    }

    public function getAll() {
        return parent::$model->with('unit')->orderBy('id','asc')->get();
    }
}