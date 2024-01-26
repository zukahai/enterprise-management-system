<?php

namespace App\Http\Controllers\main;

use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use App\Http\Controllers\Controller;
use App\Http\Services\UnitService;

class UnitController extends Controller
{
    public function __construct(UnitService $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        return View('admin.pages.unit.index');
    }

    public function create(StoreUnitRequest $request)
    {
        $object = $request->all();
        $this->service->create($object);
        return redirect()->back()->with('success','Thêm đơn vị thành công');
    }

    public function update(UpdateUnitRequest $request, $id)
    {
        $object = $request->all();
        $object_update = $this->service->update($id, $object);
        return redirect()->back()->with('success','Sửa thông tin đơn vị thành công');
    }

}
