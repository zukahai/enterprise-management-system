<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function unit() {
        return $this->hasOne(Unit::class, 'id', 'unit_id');
    }
}
