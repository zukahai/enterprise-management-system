<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

use App\Http\Services\RoleService;


class RoleController extends Controller
{
    
    public $data = [];

    public function __construct(RoleService $service)
    {
        $this->service = $service;
    }

    // Đưa ra tất cả các role
    public function index()
    {
        $roles = $this->service->getAll();
        return response()->json($roles, 200, [], JSON_UNESCAPED_UNICODE);
    }


    /* 
    Thêm vai trò cho hệ thống
    StoreRoleRequest có các attribute là role_name, description
    */
    public function store(StoreRoleRequest $request)
    {
        // Kiểm tra xem request có lỗi không
        $object = $request->all();
        $object = $this->service->add($object);
        return response()->json($object, 201, [], JSON_UNESCAPED_UNICODE);
    }

    // Thông tin 1 role
    public function show($id)
    {
        $role = $this->service->find($id);
        return response()->json($role, 200, [], JSON_UNESCAPED_UNICODE);
    }

   /*
   Cập nhật role
   */
    public function update($id, UpdateRoleRequest $request)
    {
        $object = $this->service->update($id, $request->all());
        return response()->json($object, 200, [], JSON_UNESCAPED_UNICODE);
    }

    /*
    Xoá 1 role
    */ 
    public function destroy($id)
    {
        $id = $this->service->delete($id);
        return response()->json($id, 204, [], JSON_UNESCAPED_UNICODE);
    }
}
