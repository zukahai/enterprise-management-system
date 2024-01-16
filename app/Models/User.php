<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class User extends Model implements Authenticatable
{
    use HasFactory, HasApiTokens, AuthenticatableTrait;
    protected $guarded = [];

    public function role() {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
}
