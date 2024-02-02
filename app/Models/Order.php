<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customer() {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function exportOrders() {
        return $this->hasMany(ExportOrder::class, 'order_id', 'id');
    }
}
