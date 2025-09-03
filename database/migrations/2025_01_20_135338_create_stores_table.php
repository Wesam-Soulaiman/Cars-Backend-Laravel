<?php

use App\Statuses\StoreStatus;
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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_ar');
            $table->string('address');
            $table->string('address_ar');
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('photo')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp_phone')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('premium')->default(false);
            $table->foreignId('store_type_id')->nullable()->constrained('store_types')->nullOnDelete();
            $table->foreignId('governorate_id')->nullable()->constrained('governorates')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
