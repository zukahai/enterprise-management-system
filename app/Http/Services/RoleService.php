<?php

namespace App\Http\Services;


use App\Models\Role;

class RoleService extends BaseService
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    public function findByRoleName($roleName) {
        return parent::$model->where('role_name', $roleName)->first();
    }
}