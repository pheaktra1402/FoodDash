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
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurantId')->constrained('restaurants')->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->string('imageUrl');
            $table->float('price');
            $table->float('oldPrice')->nullable();
            $table->float('rating');
            $table->json('ingredients');
            $table->json('extraToppings');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
