<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product_photos = [
            [
                'product_id' => 1, // Honda Civic
                'photo' => '/asset/product/BMW.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1,
                'photo' => '/asset/product/BMW.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2, // Toyota Corolla
                'photo' => '/asset/product/BMW.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'photo' => '/asset/product/BMW.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3, // Ford Mustang
                'photo' => '/asset/product/BMW.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3,
                'photo' => '/asset/product/BMW.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 4, // Honda Civic (Blue)
                'photo' => '/asset/product/BMW.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 4,
                'photo' => '/asset/product/BMW.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('product_photos')->insert($product_photos);
    }
}
