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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username'); //mã nhân viên, dùng để đăng nhập
            $table->string('password');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->date('birthday')->nullable();
            $table->string('cccd')->nullable(); // Lưu căn cước công dân
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->unsignedBigInteger('business_day')->default(0); // Ngày công
            $table->unsignedBigInteger('allowance')->default(0); // phụ cấp
            $table->string('insurance')->nullable(); // Bảo hiểm
            $table->string('file_link')->nullable(); // File
            $table->string('note')->nullable(); // Ghi chú
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
