<?php

namespace App\Http\Services;

use App\Models\Supplier;

class SupplierService
{
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
        $ojbect= $this->model->find($id);
        if (!$ojbect)  return -1;
        $ojbect->delete();
        return $id;
    }

    public function update($id, $data) {
        try {
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
        //lọc những trường khác null trong data
        $data = array_filter($data, function ($value) {
            return !is_null($value);
        });
        $ojbect = $this->model->create($data);
        return $ojbect;
    }
}