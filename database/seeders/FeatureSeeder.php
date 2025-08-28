<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            ['name' => 'Navigation System', 'name_ar' => 'نظام الملاحة'],
            ['name' => 'Leather Seats', 'name_ar' => 'مقاعد جلدية'],
            ['name' => 'Backup Camera', 'name_ar' => 'كاميرا احتياطية'],
            ['name' => 'Bluetooth', 'name_ar' => 'بلوتوث'],
            ['name' => 'Heated Seats', 'name_ar' => 'مقاعد مدفأة'],
            ['name' => 'Keyless Entry', 'name_ar' => 'دخول بدون مفتاح'],
        ];

        foreach ($features as $feature) {
            Feature::create($feature);

        }
    }
}
