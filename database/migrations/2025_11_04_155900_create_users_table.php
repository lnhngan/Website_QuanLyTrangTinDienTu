<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ĐÂY LÀ ĐOẠN "UP" BẠN CẦN
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 150)->unique();
            $table->timestamp('email_verified_at')->nullable(); // Thêm cho Laravel
            $table->string('password'); // 255 là mặc định
            
            // Các cột của bạn từ file SQL
            $table->enum('role', ['admin','editor','reporter','user'])->default('user');
            $table->string('avatar', 255)->nullable();
            
            $table->rememberToken(); // Thêm cho Laravel
            $table->timestamps(); // Tự động tạo created_at và updated_at
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
}