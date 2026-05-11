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
        Schema::create('foods', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->id(); // Primary key
            $table->foreignId('category_id')->constrained('food_categories')->cascadeOnDelete(); // Food belongs to category
            $table->foreignId('hotel_id')->constrained()->cascadeOnDelete(); // Food belongs to hotel
            $table->string('name'); // Food name
            $table->decimal('price',10,2); // Food price
            $table->text('description')->nullable(); // Food description
            $table->decimal('discount',5,2)->default(0); // Discount amount
            $table->string('status')->default('available'); // available / unavailable
            $table->string('profile_photo')->nullable(); // Food image
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};
