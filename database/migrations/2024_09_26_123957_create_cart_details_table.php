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
        Schema::create('cart_orders', function (Blueprint $table) {
            $table->id();
            $table->string('ref_order_id');
            $table->string('customer');
            $table->string('payment');
            $table->string('payment_value');
            $table->string('discount');
            $table->string('discount_value');
            $table->string('vat3');
            $table->string('vat7');
            $table->double('price');
            $table->string('comment');
            $table->string('sdate');
            $table->string('edate');
            $table->string('total');
            $table->string('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
