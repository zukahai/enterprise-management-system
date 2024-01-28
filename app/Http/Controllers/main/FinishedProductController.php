<?php

namespace App\Http\Controllers\main;

use App\Http\Requests\StoreBankRequest;
use App\Http\Requests\UpdateBankRequest;
use App\Http\Controllers\Controller;
use App\Http\Services\FinishedProductService;

class FinishedProductController extends Controller
{
    public function __construct(FinishedProductService $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        return View('admin.pages.finished-product.index');
    }

    public function create(StoreBankRequest $request)
    {
        $object = $request->all();
        $this->service->create($object);
        return redirect()->back()->with('success','Thêm thành phẩm thành công');
    }

    public function update(UpdateBankRequest $request, $id)
    {
        $object = $request->all();
        // dd($object);
        $object_update = $this->service->update($id, $object);
        return redirect()->back()->with('success','Sửa thông tin thành phẩm thành công');
    }

}
