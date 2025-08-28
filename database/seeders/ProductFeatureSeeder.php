<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $productFeatures = [
            ['product_id' => 1, 'feature_id' => 1], // Civic: Navigation
            ['product_id' => 1, 'feature_id' => 4], // Civic: Bluetooth
            ['product_id' => 2, 'feature_id' => 3], // Corolla: Backup Camera
            ['product_id' => 2, 'feature_id' => 6], // Corolla: Keyless Entry
            ['product_id' => 3, 'feature_id' => 2], // Mustang: Leather Seats
            ['product_id' => 3, 'feature_id' => 4], // Mustang: Bluetooth
            ['product_id' => 4, 'feature_id' => 5], // Civic (rent): Heated Seats
            ['product_id' => 4, 'feature_id' => 6], // Civic (rent): Keyless Entry
        ];

        foreach ($productFeatures as $productFeature) {
            DB::table('product_features')->insert([
                $productFeature,
            ]);
        }

    }
}
