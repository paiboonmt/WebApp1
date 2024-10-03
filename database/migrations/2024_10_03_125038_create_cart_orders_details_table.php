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
        Schema::create('cart_orders_details', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('product_id');
            $table->string('product_name');
            $table->decimal('price',8,2);
            $table->unsignedInteger('quantity');
            $table->decimal('total',8,2);
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_orders_details');
    }
};
