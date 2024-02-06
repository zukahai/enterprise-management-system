<?php

namespace App\Http\Services;
use Carbon\Carbon;
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
            if (isset($data['delivery_date'])) {
                $data['delivery_date'] = Carbon::createFromFormat('d/m/Y', $data['delivery_date'])->format('Y-m-d');
            }
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

    public function createOrederID($customer_id) {
        $customer = $this->customerService->getById($customer_id);
        $count_order = $customer->orders->count();
        $index_next_order = $count_order + 1;
        $index_next_order = sprintf("%05s", $index_next_order);
        $twoDigitYear = date('y');
        $order_id_custom = $customer->id_custom . '-' . $twoDigitYear . 'X' . $index_next_order;
        return $order_id_custom;
    }

    public function create($data) {
        $order_id_custom = $this->createOrederID($data['customer_id']);
        
        $order = $this->orderService->create([
            'id_custom' => $order_id_custom,
            'customer_id' => $data['customer_id']
        ]);

        $data['order_id'] = $order->id;
        $data['customer_id'] = null;

        $step = 1;
        $count_order = $data['count_order'];
        $data['finished_product_id_'.$count_order] = $data['finished_product_id'];
        $data['count_'.$count_order] = $data['count'];
        $data['delivery_date_'.$count_order] = $data['delivery_date'];

        $object_data = [];
        $object_data['order_id'] = $order->id;
        for ($i = 1; $i <= $count_order; $i++) {
            if (isset($data['finished_product_id_'.$i])) {
                $object_data['finished_product_id'] =  $data['finished_product_id_'.$i];
                $object_data['count'] =  $data['count_'.$i];
                $object_data['delivery_date'] =  Carbon::createFromFormat('d/m/Y', $data['delivery_date_'.$i])->format('Y-m-d');
                $object_data['internal_code'] = $order_id_custom.'/'.$step;
                $this->model->create($object_data);
                $step++;
            }
        }

        return $data;
    }
}