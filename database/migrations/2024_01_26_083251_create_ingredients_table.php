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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('width')->default(0)->nullable();
            $table->unsignedBigInteger('height')->default(0)->nullable();
            $table->unsignedBigInteger('length')->default(0)->nullable();
            $table->unsignedBigInteger('buying_price')->default(0)->nullable();
            $table->unsignedBigInteger('selling_price')->default(0)->nullable();
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->string('note')->default('')->nullable();
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
        Schema::dropIfExists('ingredients');
    }
};
