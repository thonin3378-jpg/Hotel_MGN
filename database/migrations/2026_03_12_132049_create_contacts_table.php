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
        Schema::create('contacts', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->id(); // Primary key
            $table->string('name'); // Person sending message
            $table->string('email'); // Contact email
            $table->string('phone')->nullable(); // Phone number
            $table->string('subject'); // Message subject
            $table->text('message'); // Message content
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
