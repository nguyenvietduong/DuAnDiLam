<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone')->unique();
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('status')->default('normal'); // Trạng thái tài khoản ['normal', 'locked', 'warning']
            $table->integer('code_sent')->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            // Tạo cột ngoại khóa mà không tự động đánh index
            $table->unsignedBigInteger('role_id');

            // Khai báo khóa ngoại và đánh index
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->index('role_id'); // Đánh index cho role_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
