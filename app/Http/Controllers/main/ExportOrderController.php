<?php

namespace App\Http\Controllers\main;

use App\Http\Requests\StoreExportOrderRequest;
use App\Http\Requests\UpdateExportOrderRequest;
use App\Http\Controllers\Controller;
use App\Http\Services\CustomerService;
use App\Http\Services\ExportOrderService;
use App\Http\Services\OrderService;

class ExportOrderController extends Controller
{
    public function __construct(
        ExportOrderService $service, 
        OrderService $orderService,
        CustomerService $customerService)
    {
        $this->service = $service;
        $this->orderService = $orderService;
        $this->customerService = $customerService;
    }
    public function index()
    {
        return View('admin.pages.export-order.index');
    }

    public function create(StoreExportOrderRequest $request)
    {
        $object = $request->all();
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
