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
            $table->bigInteger('xa')->default(0)->nullable();
            $table->bigInteger('x')->default(0)->nullable();
            $table->string('mold')->default('')->nullable(); // Phim khuôn
            $table->bigInteger('n_color')->default(0)->nullable();
            $table->bigInteger('in')->default(0)->nullable();
            $table->bigInteger('in_n')->default(0)->nullable();
            $table->bigInteger('boi')->default(0)->nullable();
            $table->bigInteger('boi_n')->default(0)->nullable();
            $table->bigInteger('mang')->default(0)->nullable();
            $table->bigInteger('mang_n')->default(0)->nullable();
            $table->bigInteger('be')->default(0)->nullable();
            $table->bigInteger('be_n')->default(0)->nullable();
            $table->bigInteger('chap')->default(0)->nullable();
            $table->bigInteger('chap_n')->default(0)->nullable();
            $table->bigInteger('dong')->default(0)->nullable();
            $table->bigInteger('dong_n')->default(0)->nullable();
            $table->bigInteger('dan')->default(0)->nullable();
            $table->bigInteger('dan_n')->default(0)->nullable();
            $table->bigInteger('other')->default(0)->nullable();
            $table->bigInteger('other_n')->default(0)->nullable();

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
