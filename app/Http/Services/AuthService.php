<?php

namespace App\Http\Services;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Services\RoleService;

use App\Models\User;

class AuthService
{
    public function __construct(User $model, RoleService $roleService)
    {
        $this->model = $model;
        $this->roleService = $roleService;
    }

    public function login($request) {
        $credentials = $request->only('username', 'password');
        return Auth::attempt($credentials);
    }

    public function register($request) {
        $role_name_default = config('app.DEFAULT_ROLE_USER');
        $role = $this->roleService->findByRoleName($role_name_default);
        $user = User::create([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'role_id' => $role->id,
        ]);
        return $user;
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

    public function changePassword($id, $data) {
        $user = $this->model->find($id);
        $user->password = Hash::make($data['password']);
        $user->save();
        return $user;
    }

    public function add($data) {
        $ojbect = $this->model->create($data);
        return $ojbect;
    }

    public function find($id) {
        return $this->model->find($id);
    }

    public function loginSystem($user) {
        auth()->login($user);
    }

}