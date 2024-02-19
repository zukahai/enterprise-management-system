<?php

namespace App\Http\Services;
use Carbon\Carbon;

use App\Models\Customer;

class CustomerService
{
    protected $model;
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
            $data = $ojbect;
            if (!$ojbect)  return -1;
                $ojbect->delete();
            //Lưu activity
            OtherSevice::activityDelete($data);
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
            //Lấy thông tin đối tượng cũ
            $oldData = $this->getById($id);
            // Cập nhật đối tượng
            $this->model->where('id', $id)->update($data);
            // Lấy đối tượng đã được cập nhật
            $updatedObject = $this->getById($id);
            //Lưu activity
            OtherSevice::activityUpdate($oldData, $updatedObject);

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
        //lọc những trường khác null trong data
        $data = array_filter($data, function ($value) {
            return !is_null($value);
        });
        $ojbect = $this->model->create($data);
        // Lưu activity
        OtherSevice::activityCreate($ojbect);
        return $ojbect;
    }
}