<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('models')->insert([
            ['brand_id' => 1, 'name' => 'Civic EX'],
            ['brand_id' => 1, 'name' => 'Accord LX'],
            ['brand_id' => 2, 'name' => 'Model 3'],
            ['brand_id' => 3, 'name' => 'Camry SE'],
            ['brand_id' => 4, 'name' => 'Altima SV'],
            ['brand_id' => 5, 'name' => 'Mustang GT'],
            ['brand_id' => 6, 'name' => 'Wrangler Rubicon'],
            ['brand_id' => 7, 'name' => 'Malibu LT'],
            ['brand_id' => 8, 'name' => 'Q5 Premium'],
            ['brand_id' => 9, 'name' => '330i'],
        ]);

    }
}
