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
            Schema::create('services', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('name_ar');
                $table->foreignId('category_service_id')->constrained('category_services');
                $table->boolean('has_top_result')->default(false);
                $table->json('services'); // e.g., ["sale", "rent", "parts"]                $table->text('description')->nullable();
                $table->text('description')->nullable();
                $table->text('description_ar')->nullable();
                $table->integer('count_product')->nullable();
                $table->integer('count_days')->nullable();
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
