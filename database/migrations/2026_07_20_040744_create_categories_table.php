<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('categories', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('category_code', 50)->unique();
    //         $table->string('category_name', 150);
    //         $table->text('description')->nullable();
    //         $table->enum('status', ['Active', 'Inactive'])->default('Active');
    //         $table->timestamps();
    //     });
    // }

public function up(): void
{
    // Check if the table DOES NOT exist before trying to create it
    if (!Schema::hasTable('categories')) {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_code', 50);
            $table->string('category_name', 150);
            $table->text('description')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
