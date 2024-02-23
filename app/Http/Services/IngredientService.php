<?php

namespace App\Http\Services;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Ingredient;

class IngredientService extends BaseService
{
    protected $model;
    public function __construct(Ingredient $model)
    {
        $this->model = $model;
    }

    public function getAll() {
        return $this->model->with('unit')->orderBy('id','asc')->get();
    }
}