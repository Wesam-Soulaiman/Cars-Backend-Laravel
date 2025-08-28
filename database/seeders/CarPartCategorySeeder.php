<?php

namespace Database\Seeders;

use App\Models\CarPartCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarPartCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Engine', 'name_ar' => 'محرك'],
            ['name' => 'Brakes', 'name_ar' => 'مكابح'],
            ['name' => 'Suspension', 'name_ar' => 'تعليق'],
            ['name' => 'Transmission', 'name_ar' => 'ناقل الحركة'],
            ['name' => 'Exhaust', 'name_ar' => 'عادم'],
            ['name' => 'Electrical', 'name_ar' => 'كهربائي'],
        ];

        foreach ($categories as $category) {
            CarPartCategory::create($category);
        }
    }
}
