<?php

namespace App\Http\Services;


use App\Models\Role;

class RoleService extends BaseService
{
    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    public function findByRoleName($roleName) {
        return $this->model->where('role_name', $roleName)->first();
    }
}