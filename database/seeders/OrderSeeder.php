<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::create([
            'store_id' => 1,
            'service_id' => 1, // Search Result
            'active' => true,
            'start_time' => now()->subDays(10),
            'end_time' => now()->addDays(20),
            'remaining_count_product' => 10,
        ]);
        Order::create([
            'store_id' => 2,
            'service_id' => 2, // Premium Sale
            'active' => true,
            'start_time' => now()->subDays(5),
            'end_time' => now()->addDays(55),
            'remaining_count_product' => 20,
        ]);
        Order::create([
            'store_id' => 3,
            'service_id' => 4, // Parts Promotion
            'active' => true,
            'start_time' => now()->subDays(2),
            'end_time' => now()->addDays(13),
            'remaining_count_product' => 5,
        ]);
    }
}
