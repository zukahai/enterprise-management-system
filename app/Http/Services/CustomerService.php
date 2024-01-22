<?php

namespace App\Http\Services;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Services\RoleService;

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
        return $this->model->orderBy('id','asc')->get();
    }

    public function getById($id) {
        return $this->model->find($id);
    }

    public function delete($id) {
        $ojbect= $this->model->find($id);
        if (!$ojbect)  return -1;
        $ojbect->delete();
        return $id;
    }

    public function update($id, $data) {
        try {
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

    public function add($data) {
        $ojbect = $this->model->create($data);
        return $ojbect;
    }
}