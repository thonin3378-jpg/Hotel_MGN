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
        Schema::create('food_orders', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->id(); // Primary key
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete(); // Order belongs to customer
            $table->date('order_date'); // Order date
            $table->decimal('total_price',10,2); // Total order amount
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods_orders');
    }
};
