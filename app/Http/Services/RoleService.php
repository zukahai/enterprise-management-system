<?php

namespace App\Http\Services;


use App\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RoleService
{
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    public function findByRoleName($roleName){
        return $this->model->where('role_name', '=', $roleName)->first();
    }

    public function getAll() {
        return $this->model->orderBy('id','asc')->paginate();
    }

    public function delete($id) {
        $ojbect= $this->model->find($id);
        if (!$ojbect)  return;
        $ojbect->delete();
        return $id;
    }

    public function update($id, $data)
    {
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

    public function find($id) {
        return $this->model->find($id);
    }


    public function paginate($limit, $keywords){
        $role = $this->role;
        $role = $role->orderBy('created_at','desc');
        if (!empty($keywords)) {
            $role->where('role_name', 'like', '%'. $keywords.'%');
            $role->orWhere('description', 'like', '%'. $keywords.'%');
        }
        return $role->paginate($limit)->withQueryString();
    }

}