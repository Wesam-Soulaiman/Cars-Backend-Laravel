<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $offers = [
            [
                'product_id' => 1, // Honda Civic
                'final_price' => 22000.00, // Discounted from ~25000
                'start_time' => '2025-01-01',
                'end_time' => '2025-12-31',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2, // Toyota Corolla
                'final_price' => 90.00, // Discounted from ~100
                'start_time' => '2025-01-01',
                'end_time' => '2025-06-30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3, // Another product
                'final_price' => 1800.00, // Discounted from ~2000
                'start_time' => '2025-02-01',
                'end_time' => '2025-09-30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('offers')->insert($offers);
    }
}
