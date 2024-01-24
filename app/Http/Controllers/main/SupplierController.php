<?php

namespace App\Http\Controllers\main;

use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Http\Controllers\Controller;
use App\Http\Services\SupplierService;
use App\Http\Services\BankService;

class SupplierController extends Controller
{
    public function __construct(SupplierService $service, BankService $bankService)
    {
        $this->service = $service;
        $this->bankService = $bankService;
    }
    public function index()
    {
        return View('admin.pages.supplier.index');
    }

    public function create(StoreSupplierRequest $request)
    {
        $object = $request->only('name', 'note');
        $this->service->create($object);
        return redirect()->back()->with('success','Thêm nhà cung cấp thành công');
    }

    public function update(UpdateSupplierRequest $request, $id)
    {
        $object = $request->only('name', 'mst', 'time', 'contact', 'address', 'phone_number', 'note');
        $object_update = $this->service->update($id, $object);
        return redirect()->back()->with('success','Sửa thông tin nhà cung cấp thành công');
    }

}
