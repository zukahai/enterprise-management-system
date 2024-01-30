<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportOrder extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function customer() {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function finishedProduct() {
        return $this->hasOne(FinishedProduct::class, 'id', 'finished_product_id');
    }
}
