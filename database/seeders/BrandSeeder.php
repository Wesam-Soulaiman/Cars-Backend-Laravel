<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('brands')->insert([
            ['name' => 'Honda', 'logo' => 'brand-pmw.jpg'],
            ['name' => 'Tesla', 'logo' => 'brand-pmw.jpg'],
            ['name' => 'Toyota', 'logo' => 'brand-pmw.jpg'],
            ['name' => 'Nissan', 'logo' => 'brand-pmw.jpg'],
            ['name' => 'Ford', 'logo' => 'brand-pmw.jpg'],
            ['name' => 'Jeep', 'logo' => 'brand-pmw.jpg'],
            ['name' => 'Chevrolet', 'logo' => 'brand-pmw.jpg'],
            ['name' => 'Audi', 'logo' => 'brand-pmw.jpg'],
            ['name' => 'BMW', 'logo' => 'brand-pmw.jpg'],
        ]);

    }
}
