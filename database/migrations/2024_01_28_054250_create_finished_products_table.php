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
        Schema::create('finished_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('ktdh_length')->default(0)->nullable();
            $table->unsignedBigInteger('ktdh_width')->default(0)->nullable();
            $table->unsignedBigInteger('ktdh_height')->default(0)->nullable();
            $table->unsignedBigInteger('ktsx_length')->default(0)->nullable();
            $table->unsignedBigInteger('ktsx_width')->default(0)->nullable();
            $table->unsignedBigInteger('ktsx_height')->default(0)->nullable();
            $table->string('song')->default('')->nullable();
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('price')->default(0)->nullable();
            $table->unsignedBigInteger('rose')->default(0)->nullable();
            $table->unsignedBigInteger('rose_percent')->default(0)->nullable();
            $table->string('note')->default('')->nullable();
            $table->string('type')->default('')->nullable();
            $table->string('delivered_enough')->default(0)->nullable();
            $table->unsignedBigInteger('xa')->default(0)->nullable();
            $table->string('mold')->default('')->nullable(); // Ph8m khuôn
            $table->unsignedBigInteger('n_color')->default(0)->nullable();
            $table->unsignedBigInteger('in')->default(0)->nullable();
            $table->unsignedBigInteger('in_n')->default(0)->nullable();
            $table->unsignedBigInteger('boi')->default(0)->nullable();
            $table->unsignedBigInteger('boi_n')->default(0)->nullable();
            $table->unsignedBigInteger('mang')->default(0)->nullable();
            $table->unsignedBigInteger('mang_n')->default(0)->nullable();
            $table->unsignedBigInteger('be')->default(0)->nullable();
            $table->unsignedBigInteger('be_n')->default(0)->nullable();
            $table->unsignedBigInteger('chap')->default(0)->nullable();
            $table->unsignedBigInteger('chap_n')->default(0)->nullable();
            $table->unsignedBigInteger('dong')->default(0)->nullable();
            $table->unsignedBigInteger('dong_n')->default(0)->nullable();
            $table->unsignedBigInteger('dan')->default(0)->nullable();
            $table->unsignedBigInteger('dan_n')->default(0)->nullable();
            $table->unsignedBigInteger('other')->default(0)->nullable();
            $table->unsignedBigInteger('other_n')->default(0)->nullable();

            $table->foreign('unit_id')->references('id')->on('units');
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
        Schema::dropIfExists('finished_products');
    }
};
