<?php

namespace Database\Seeders;

use App\Models\FuelType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fuelTypes = [
            ['name' => 'Petrol', 'name_ar' => 'بنزين'],
            ['name' => 'Diesel', 'name_ar' => 'ديزل'],
            ['name' => 'Hybrid', 'name_ar' => 'هجين'],
            ['name' => 'Electric', 'name_ar' => 'كهربائي'],
        ];

        foreach ($fuelTypes as $fuelType) {
            FuelType::create($fuelType);
        }
    }
}
