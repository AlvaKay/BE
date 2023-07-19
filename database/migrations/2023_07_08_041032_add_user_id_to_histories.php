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
        Schema::table('histories', function (Blueprint $table) {
            $table->integer('user_id')->change(10); // Sử dụng kiểu dữ liệu unsigned big integer

            $table->foreign('user_id') // Thiết lập cột user_id là khóa ngoại
                ->references('user_id') // Tham chiếu đến khóa chính user_id trong bảng users
                ->on('users')
                ->onDelete('RESTRICT')
                ->onUpdate('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('histories', function (Blueprint $table) {
            //
        });
    }
};
