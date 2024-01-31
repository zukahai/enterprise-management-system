<?php

namespace App\Http\Controllers\main;

use App\Http\Requests\StoreExportOrderRequest;
use App\Http\Requests\UpdateExportOrderRequest;
use App\Http\Controllers\Controller;
use App\Http\Services\ExportOrderService;

class ExportOrderController extends Controller
{
    public function __construct(ExportOrderService $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        return View('admin.pages.export-order.index');
    }

    public function create(StoreExportOrderRequest $request)
    {
        $object = $request->all();
        // dd($object);
        $this->service->create($object);
        return redirect()->back()->with('success','Thêm đơn hàng xuất thành công');
    }

    public function update(UpdateExportOrderRequest $request, $id)
    {
        $object = $request->all();
        $object_update = $this->service->update($id, $object);
        return redirect()->back()->with('success','Sửa thông tin đơn hàng xuất thành công');
    }

}
