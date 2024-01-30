<?php

namespace App\Http\Controllers\main;

use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Http\Controllers\Controller;
use App\Http\Services\SupplierService;
use App\Http\Services\BankService;

class SupplierController extends Controller
{
    public $data = [];

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
        $object = $request->only('name', 'address', 'mst', 'stk', 'bank_id', 'time', 'contact', 'phone_number', 'note');
        $this->service->create($object);
        return redirect(route('supplier.index'))->with('success','Thêm nhà cung cấp thành công');
    }

    public function update(UpdateSupplierRequest $request, $id)
    {
        $object = $request->only('name', 'address', 'mst', 'stk', 'bank_id', 'time', 'contact', 'phone_number', 'note');
        $object_update = $this->service->update($id, $object);
        return redirect()->back()->with('success','Sửa thông tin nhà cung cấp thành công');
    }

    public function show($id) {
        $object = $this->service->getById($id);
        if ($object) {
            $this->data['object'] = $object;
            return view('admin.pages.supplier.detail', $this->data);
        }
        return redirect(route('supplier.index'))->with('error', 'Không tìm thấy nhà cung cấp');
    }

}
