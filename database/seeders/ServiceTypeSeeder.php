<?php

namespace Database\Seeders;

use App\Models\ServiceType;
use Illuminate\Database\Seeder;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceType::create([
            'name' => 'Premium Plan ',
            'service_id' => 1,
            'description' => 'description',
            'price' => 200.00,
            'count_days' => 60,
            'count_product' => null,
        ]);
    }
}
