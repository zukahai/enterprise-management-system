<?php

namespace App\Http\Controllers\main;

use App\Http\Requests\StoreIngredientRequest;
use App\Http\Requests\UpdateIngredientRequest;
use App\Http\Controllers\Controller;
use App\Http\Services\IngredientService;

class IngredientController extends Controller
{
    public function __construct(IngredientService $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        return View('admin.pages.ingredient.index');
    }

    public function create(StoreIngredientRequest $request)
    {
        $object = $request->all();
        $this->service->create($object);
        return redirect()->back()->with('success','Thêm nguyên liệu thành công');
    }

    public function update(UpdateIngredientRequest $request, $id)
    {
        $object = $request->all();
        $object_update = $this->service->update($id, $object);
        return redirect()->back()->with('success','Sửa thông tin nguyên liệu thành công');
    }

}
