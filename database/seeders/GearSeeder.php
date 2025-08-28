<?php

namespace Database\Seeders;

use App\Models\Gear;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gears = [
            ['name' => 'Manual', 'name_ar' => 'يدوي'],
            ['name' => 'Automatic', 'name_ar' => 'أوتوماتيك'],
            ['name' => 'Semi-Automatic', 'name_ar' => 'نصف أوتوماتيك'],
        ];

        foreach ($gears as $gear) {
            Gear::create($gear);
        }
    }
}
