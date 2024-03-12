<?php

namespace App\Http\Controllers\main;

use App\Http\Services\OtherService;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Services\CustomerService;

class CustomerController extends Controller
{
    protected $service;
    public function __construct(
        CustomerService $customerService,
        OtherService $otherService
    )
    {
        $this->service = $customerService;
        $this->otherService = $otherService;
    }
    public function index()
    {
        return View('admin.pages.customer.index');
    }

    public function create(StoreCustomerRequest $request)
    {
        $object = $request->all();
        $this->service->create($object);
        return redirect()->route('customer.index')->with('success','Thêm khách hàng thành công');
    }

    public function store(StoreCustomerRequest $request)
    {
        //
    }

    public function show($id) {
        $object = $this->service->getById($id);
        if ($object) {
            $this->data['object'] = $object;
            return view('admin.pages.customer.detail', $this->data);
        }
        return redirect(route('customer.index'))->with('error', 'Không tìm thấy thành phẩm');
    }

    public function edit(Customer $customer)
    {
        //
    }

    public function update(UpdateCustomerRequest $request, $id)
    {
        $object = $request->all();
        $object_update = $this->service->update($id, $object);
        return redirect()->back()->with('success','Sửa thông tin khách hàng thành công');
    }

    public function activity($id, $subject_type = null) {
        $subject_type = "App\Models\Customer";
        // parent::activity($subject_type, $id);
        $condition = ['subject_type' => $subject_type, 'subject_id' => $id];
        $data['activities'] = $this->otherService->getActivitesOfUser($condition);
        return View('admin.pages.customer.activity', $data);
    }

    public function destroy(Customer $customer)
    {
        //
    }
}
