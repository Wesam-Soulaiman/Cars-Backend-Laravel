<?php

namespace Database\Seeders;

use App\Models\Light;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lights = [
            ['name' => 'Halogen', 'name_ar' => 'هالوجين'],
            ['name' => 'LED', 'name_ar' => 'إل إي دي'],
            ['name' => 'Xenon', 'name_ar' => 'زينون'],
        ];

        foreach ($lights as $light) {
            Light::create($light);
        }
    }
}
