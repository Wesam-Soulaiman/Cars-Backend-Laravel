<?php

use App\Statuses\ProductStatus;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();
            $table->foreignId('store_id')->constrained('stores')->cascadeOnDelete();
            $table->foreignId('model_id')->nullable()->constrained('models')->nullOnDelete();
            $table->foreignId('color_id')->nullable()->constrained('colors')->nullOnDelete();
            $table->integer('structure_id')->nullable();
            $table->string('main_photo');
            $table->decimal('price', 10, 2)->nullable();
            $table->integer('mileage')->nullable();
            $table->year('year_of_construction');
            $table->year('register_year');
            $table->integer('number_of_seats');
            $table->integer('drive_type');
            $table->integer('fuel_type');
            $table->integer('cylinders');
            $table->decimal('cylinder_capacity', 10, 2);
            $table->text('additional_features')->nullable();
            $table->integer('gears');
            $table->integer('type');
            $table->integer('seat_type');
            $table->boolean('sunroof')->default(ProductStatus::SUNROOF_NO);
            $table->string('lights');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
