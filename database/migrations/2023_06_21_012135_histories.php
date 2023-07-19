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
        Schema::create('histories', function (Blueprint $table) {
            $table->increments('history_id');
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('combo_id');
            $table->unsignedBigInteger('payment_id');
            $table->unsignedBigInteger('stylist_id');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->timestamps();

            $table->foreign('shop_id')->references('shop_id')->on('shops');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('service_id')->references('service_id')->on('services');
            $table->foreign('combo_id')->references('combo_id')->on('combo');
            $table->foreign('payment_id')->references('payment_id')->on('payments');
            $table->foreign('stylist_id')->references('stylist_id')->on('stylists');
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
