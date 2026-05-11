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
        Schema::create('food_order_items', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->id(); // Primary key
            $table->foreignId('order_id')->constrained('food_orders')->cascadeOnDelete(); // Item belongs to order
            $table->foreignId('food_id')->constrained('foods')->cascadeOnDelete(); // Ordered food
            $table->integer('qty'); // Quantity ordered
            $table->decimal('price',10,2); // Price per item
            $table->decimal('discount',5,2)->default(0); // Discount
            $table->decimal('total',10,2); // Total price
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods_order_items');
    }
};
