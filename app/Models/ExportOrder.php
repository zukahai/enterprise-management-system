<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportOrder extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function order() {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }

    public function finishedProduct() {
        return $this->hasOne(FinishedProduct::class, 'id', 'finished_product_id');
    }
}
