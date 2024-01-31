<?php

namespace App\Http\Controllers\main;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Services\CustomerService;


class CustomerController extends Controller
{
    
    public function __construct(CustomerService $customerService)
    {
        $this->service = $customerService;
    }
    public function index()
    {
        return View('admin.pages.customer.index');
    }

    public function create(StoreCustomerRequest $request)
    {
        $object = $request->only('name', 'mst', 'time', 'contact', 'address', 'phone_number', 'note');
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
        $object = $request->only('name', 'mst', 'time', 'contact', 'address', 'phone_number', 'note');
        $object_update = $this->service->update($id, $object);
        return redirect()->back()->with('success','Sửa thông tin khách hàng thành công');
    }

    public function destroy(Customer $customer)
    {
        //
    }
}
