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
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->enum('name' , ['sell' , 'daily rent' , 'monthly rent' , 'yearly rent']);
            $table->enum('name_ar' , ['بيع' , 'أجار يومي' , 'أجار شهري' , 'أجار سنوي']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_categories');
    }
};
