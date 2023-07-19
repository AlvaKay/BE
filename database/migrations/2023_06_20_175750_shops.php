<?php

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
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('shop_id');
            $table->string('shop_name');
            $table->string('shop_image')->nullable();
            $table->string('shop_phone');
            $table->unsignedInteger('user_id'); // Đổi kiểu dữ liệu thành unsignedInteger
            $table->boolean('is_shop')->default(false);
            $table->timestamps();
        
            $table->foreign('user_id')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
