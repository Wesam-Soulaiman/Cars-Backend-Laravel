<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['name' => 'Black', 'name_ar' => 'أسود'],
            ['name' => 'White', 'name_ar' => 'أبيض'],
            ['name' => 'Silver', 'name_ar' => 'فضي'],
            ['name' => 'Red', 'name_ar' => 'أحمر'],
            ['name' => 'Blue', 'name_ar' => 'أزرق'],
            ['name' => 'Green', 'name_ar' => 'أخضر'],
        ];

        foreach ($colors as $color) {
            Color::create($color);
        }
    }
}
