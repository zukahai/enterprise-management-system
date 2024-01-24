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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address')->default('')->nullable();
            $table->string('mst')->default('')->nullable();
            $table->string('stk')->default('')->nullable();
            $table->dateTime('time')->default('0000-00-00 00:00:00')->nullable();
            $table->string('email')->default('')->nullable();
            $table->string('phone_number')->default('')->nullable();
            $table->string('contact')->default('')->nullable();
            $table->string('note')->default('')->nullable();
            $table->unsignedBigInteger('bank_id');
            $table->foreign('bank_id')->references('id')->on('banks');
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
        Schema::dropIfExists('suppliers');
    }
};
