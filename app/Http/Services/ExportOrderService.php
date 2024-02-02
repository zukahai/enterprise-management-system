<?php

namespace App\Http\Services;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\ExportOrder;

class ExportOrderService
{
    public function __construct(
        ExportOrder $model, 
        CustomerService $customerService,
        OrderService $orderService
    )
    {
        $this->model = $model;
        $this->customerService = $customerService;
        $this->orderService = $orderService;
    }
   
    function countObject() {
        return $this->model->count();
    }


    public function getAll() {
        return $this->model->with(['order.customer', 'finishedProduct.unit'])->orderBy('id','desc')->get();
    }

    public function getById($id) {
        return $this->model->with(['order.customer', 'finishedProduct.unit'])->find($id);
    }

    public function delete($id) {
        try {
            $ojbect= $this->model->find($id);
            if (!$ojbect)  return -1;
            $ojbect->delete();
            return $id;
        } catch (\Exception $e) {
            return -1;
        }
    }

    public function update($id, $data) {
        try {
            $data['_token'] = null;
            $data = array_filter($data, function ($value) {
                return !is_null($value);
            });
            $this->model->where('id', $id)->update($data);

            // Lấy đối tượng đã được cập nhật
            $updatedObject = $this->model->findOrFail($id);

            return $updatedObject;
        } catch (ModelNotFoundException $e) {
            // Xử lý khi không tìm thấy đối tượng
            return ['error' => 'Đối tượng không tồn tại.'];
        } catch (\Exception $e) {
            // Xử lý lỗi khác và trả về thông báo lỗi
            return ['error' => $e->getMessage()];
        }
    }

    public function create($data) {

        $customer = $this->customerService->getById($data['customer_id']);
        $count_order = $customer->orders->count();
        $index_next_order = $count_order + 1;
        $index_next_order = sprintf("%05s", $index_next_order);
        $twoDigitYear = date('y');
        $order_id_custom = $customer->id_custom . '-' . $twoDigitYear . 'X' . $index_next_order;
        
        $order = $this->orderService->create([
            'id_custom' => $order_id_custom,
            'customer_id' => $data['customer_id']
        ]);

        $data['order_id'] = $order->id;
        $data['customer_id'] = null;

        //lọc những trường khác null trong data
        $data = array_filter($data, function ($value) {
            return !is_null($value);
        });

        $data['internal_code'] = $order_id_custom.'/1';

        $ojbect = $this->model->create($data);
        return $ojbect;
    }
}