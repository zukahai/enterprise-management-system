<?php

namespace App\Http\Services;

use Carbon\Carbon;
use App\Models\Supplier;

class SupplierService
{
    protected $model;
    public function __construct(Supplier $model)
    {
        $this->model = $model;
    }
   
    function countObject() {
        return $this->model->count();
    }


    public function getAll() {
        return $this->model->with('bank')->orderBy('id','asc')->get();
    }

    public function getById($id) {
        return $this->model->with('bank')->find($id);
    }

    public function delete($id) {
        try {
            $ojbect= $this->model->find($id);
            $data = $ojbect;
            if (!$ojbect)  return -1;
                $ojbect->delete();
            OtherSevice::activityDelete($data);
            return $id;
        } catch (\Exception $e) {
            return -1;
        }
    }

    public function update($id, $data) {
        try {
            $data = array_filter($data, function ($value) {
                return !is_null($value);
            });

            //Lấy thông tin đối tượng cũ
            $oldData = $this->getById($id);
            //Cập nhật đối tượng
            $this->model->where('id', $id)->update($data);
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