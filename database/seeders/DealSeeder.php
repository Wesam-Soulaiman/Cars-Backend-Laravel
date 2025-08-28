<?php

namespace Database\Seeders;

use App\Models\Deal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deals = [
            ['name' => 'sell', 'name_ar' => 'بيع'],
            ['name' => 'daily rent', 'name_ar' => 'أجار يومي'],
            ['name' => 'monthly rent', 'name_ar' => 'أجار شهري'],
            ['name' => 'yearly rent', 'name_ar' => 'أجار سنوي'],
        ];

        foreach ($deals as $deal) {
            Deal::create($deal);
        }
    }
}
