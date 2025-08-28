<?php

namespace Database\Seeders;

use App\Models\CarPart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarPartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parts = [
            [
                'category_id' => 1, // Engine
                'model_id' => 1, // Assume Honda Civic
                'store_id' => 1, // Assume Auto Store
                'price' => 1500.00,
                'creation_country' => 'Japan',
                'main_photo' => 'https://example.com/photos/engine1.jpg',
            ],
            [
                'category_id' => 2, // Brakes
                'model_id' => 2, // Assume Toyota Corolla
                'store_id' => 1,
                'price' => 200.00,
                'creation_country' => 'Germany',
                'main_photo' => 'https://example.com/photos/brakes1.jpg',
            ],
            [
                'category_id' => 3, // Suspension
                'model_id' => 3, // Assume Ford Mustang
                'store_id' => 2, // Assume Elite Auto
                'price' => 350.00,
                'creation_country' => 'USA',
                'main_photo' => 'https://example.com/photos/suspension1.jpg',
            ],
            [
                'category_id' => 4, // Transmission
                'model_id' => 1,
                'store_id' => 2,
                'price' => 1200.00,
                'creation_country' => 'Japan',
                'main_photo' => 'https://example.com/photos/transmission1.jpg',
            ],
            [
                'category_id' => 5, // Exhaust
                'model_id' => 2,
                'store_id' => 3, // Assume Parts Depot
                'price' => 500.00,
                'creation_country' => 'China',
                'main_photo' => 'https://example.com/photos/exhaust1.jpg',
            ],
        ];

        foreach ($parts as $part) {
            CarPart::create($part);
        }
    }
}
