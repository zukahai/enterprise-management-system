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
            $table->string('name')->default('Nguyễn Văn A');
            $table->string('email')->default('name@gmail.com');
            $table->date('birthday')->default('1980-01-01');
            $table->string('cccd')->default('123456789'); // Lưu căn cước công dân
            $table->string('address')->default('Hà Tĩnh');
            $table->string('phone_number')->default('0123456789');
            $table->string('avata')->default('images/avatas/avata.png'); // Link ảnh
            $table->unsignedBigInteger('business_day')->default(0); // Ngày công
            $table->unsignedBigInteger('allowance')->default(0); // phụ cấp
            $table->string('insurance')->default(''); // Bảo hiểm
            $table->string('file_link')->default(''); // File
            $table->string('note')->default(''); // Ghi chú
            $table->unsignedBigInteger('active')->default(1); // 1 là hoạt động, 0 là bị khoá
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
