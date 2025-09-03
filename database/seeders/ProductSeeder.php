<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Statuses\ProductStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'brand_id' => 1, // Assume Honda
                'store_id' => 1, // Auto Store
                'model_id' => 1, // Civic
                'color_id' => 1, // Black
                'fuel_type_id' => 1, // Petrol
                'gear_id' => 2, // Automatic
                'light_id' => 2, // LED
                'deal_id' => 1, // sell
                'structure_id' => 1, // Sedan
                'main_photo' => 'https://example.com/photos/car1.jpg',
                'price' => 25000.00,
                'mileage' => 50000,
                'year_of_construction' => 2020,
                'register_year' => 2021,
                'number_of_seats' => 5,
                'drive_type' => 1, // FWD
                'cylinders' => 4,
                'cylinder_capacity' => 2.0,
                'used' => 0, // Standard
                'sunroof' => ProductStatus::SUNROOF_YES,
                'creation_country'=>'korea'
            ],
            [
                'brand_id' => 2, // Assume Toyota
                'store_id' => 2, // Elite Auto
                'model_id' => 2, // Corolla
                'color_id' => 2, // White
                'fuel_type_id' => 3, // Hybrid
                'gear_id' => 2, // Automatic
                'light_id' => 1, // Halogen
                'deal_id' => 2, // daily rent
                'structure_id' => 1, // Sedan
                'main_photo' => 'https://example.com/photos/car2.jpg',
                'price' => 100.00, // Daily rental price
                'mileage' => 30000,
                'year_of_construction' => 2022,
                'register_year' => 2022,
                'number_of_seats' => 5,
                'drive_type' => 1, // FWD
                'cylinders' => 4,
                'cylinder_capacity' => 1.8,
                'used' => 0, // Rental
                'sunroof' => ProductStatus::SUNROOF_NO,
                'creation_country'=>'russia'
            ],
            [
                'brand_id' => 3, // Assume Ford
                'store_id' => 3, // Parts Depot
                'model_id' => 3, // Mustang
                'color_id' => 4, // Red
                'fuel_type_id' => 1, // Petrol
                'gear_id' => 1, // Manual
                'light_id' => 3, // Xenon
                'deal_id' => 1, // sell
                'structure_id' => 2, // Coupe
                'main_photo' => 'https://example.com/photos/car3.jpg',
                'price' => 45000.00,
                'mileage' => 20000,
                'year_of_construction' => 2021,
                'register_year' => 2021,
                'number_of_seats' => 4,
                'drive_type' => 2, // RWD
                'cylinders' => 8,
                'cylinder_capacity' => 5.0,
                'used' => 1, // Standard
                'sunroof' => ProductStatus::SUNROOF_YES,
                'creation_country'=>'korea'
            ],
            [
                'brand_id' => 1, // Honda
                'store_id' => 1, // Auto Store
                'model_id' => 1, // Civic
                'color_id' => 5, // Blue
                'fuel_type_id' => 2, // Diesel
                'gear_id' => 1, // Manual
                'light_id' => 2, // LED
                'deal_id' => 3, // monthly rent
                'structure_id' => 1, // Sedan
                'main_photo' => 'https://example.com/photos/car4.jpg',
                'price' => 2000.00, // Monthly rental price
                'mileage' => 40000,
                'year_of_construction' => 2019,
                'register_year' => 2020,
                'number_of_seats' => 5,
                'drive_type' => 1, // FWD
                'cylinders' => 4,
                'cylinder_capacity' => 1.6,
                'used' => 1, // Rental
                'sunroof' => ProductStatus::SUNROOF_NO,
                'creation_country'=>'korea'
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
