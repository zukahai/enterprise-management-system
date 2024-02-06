<?php

namespace App\Http\Services;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

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

    function countUser() {
        return $this->model->count();
    }

    public function loginByAccount($request) {
        $username = $request->username;
        $password = $request->password;
        $user = $this->model->where('username', $username)->first();
        if (!$user || !Hash::check($password, $user->password)) {
            return false;
        }
        return $user;
    }

    public function register($request) {
        // $role_name_default = config('app.DEFAULT_ROLE_USER');
        $role_name_default = 'admin';

        $role = $this->roleService->findByRoleName($role_name_default);
        $username = $request->input('username');
        $name = strtoupper($username);
        $avata = 'images/avatars/default/'.rand(1, 4).'.png';


        $user = User::create([
            'username' => $username,
            'password' => Hash::make($request->input('password')),
            'role_id' => $role->id,
            'name' => $name,
            'avata' => $avata
        ]);
        return $user;
    }

    public function create($data) {
        $role_name_default = config('app.DEFAULT_ROLE_USER');
        $role = $this->roleService->findByRoleName($role_name_default);
        $data['role_id'] = $role->id;
        $data['password'] = Hash::make($data['password']);
        if (!isset($data['avata']))
            $data['avata'] = 'images/avatars/default/'.rand(1, 4).'.png';
        if (isset($data['birthday'])) 
            $data['birthday'] = Carbon::createFromFormat('d/m/Y', $data['birthday'])->format('Y-m-d');

        $filteredData = array_filter($data, function ($value) {
            return $value !== null;
        });
        $user = User::create($filteredData);
        return $user;
    }

    public function getAll() {
        return $this->model->orderBy('id','asc')->get();
    }

    public function delete($id) {
        $ojbect= $this->model->find($id);
        if (!$ojbect)  return;
        if ($ojbect->role->role_name == 'admin')
            return;
        $ojbect->delete();
        return $id;
    }

    public function update($id, $data) {
        try {
            if (isset($data['birthday'])) 
                $data['birthday'] = Carbon::createFromFormat('d/m/Y', $data['birthday'])->format('Y-m-d');
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

    public function findByUsername($username) {
        return $this->model->where('username', $username)->first();
    }

    public function loginSystem($user) {
        auth()->login($user);
    }

}