<?php

namespace App\Http\Services;
use Carbon\Carbon;

use App\Models\Customer;

class CustomerService
{
    public function __construct(Customer $model)
    {
        $this->model = $model;
    }

   
    function countObject() {
        return $this->model->count();
    }

    public function getAll() {
        return $this->model->with(['orders.exportOrders'])->orderBy('id','asc')->get();
    }


    public function getById($id) {
        return $this->model->with(['orders'])->find($id);
    }

    public function getAllExportOrder($id) {
        $customer = $this->model->with(['orders.exportOrders'])->find($id);

        $data = [];
        foreach ($customer->orders as $order) {
            foreach ($order->exportOrders as $exportOrder) {
                $item = [
                    'order_id_customer' => $order->id_custom,
                    'internal_code' => $exportOrder->internal_code,
                    'finished_product' => [
                        'id' => $exportOrder->finishedProduct->id,
                        'name' => $exportOrder->finishedProduct->name,
                        'price' => $exportOrder->finishedProduct->price,
                    ],
                    'count' => $exportOrder->count,
                    'total' => $exportOrder->finishedProduct->price * $exportOrder->count,
                    'status' => $exportOrder->status,
                    'delivery_date' => $exportOrder->delivery_date
                ];

            $data[] = $item;
            }
        }
        return $data;
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
            if (isset($data['time'])) 
                $data['time'] = Carbon::createFromFormat('d/m/Y', $data['time'])->format('Y-m-d');
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
        if (isset($data['time'])) 
                $data['time'] = Carbon::createFromFormat('d/m/Y', $data['time'])->format('Y-m-d');
        //lọc những trường khác null trong data
        $data = array_filter($data, function ($value) {
            return !is_null($value);
        });
        $ojbect = $this->model->create($data);
        return $ojbect;
    }
}