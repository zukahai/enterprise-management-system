<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('export_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('status')->default(0);
            $table->date('delivery_date')->nullable();
            $table->string('internal_code')->nullable();
            $table->unsignedBigInteger('count');
            $table->unsignedBigInteger('finished_product_id');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('finished_product_id')->references('id')->on('finished_products');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('export_orders');
    }
};
