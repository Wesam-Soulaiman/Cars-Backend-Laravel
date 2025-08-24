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
            ['brand_id' => 1, 'name' => 'Civic EX', 'name_ar' => 'سيفيك EX'],
            ['brand_id' => 1, 'name' => 'Accord LX', 'name_ar' => 'أكورد LX'],
            ['brand_id' => 2, 'name' => 'Model 3', 'name_ar' => 'موديل 3'],
            ['brand_id' => 3, 'name' => 'Camry SE', 'name_ar' => 'كامري SE'],
            ['brand_id' => 4, 'name' => 'Altima SV', 'name_ar' => 'ألتيما SV'],
            ['brand_id' => 5, 'name' => 'Mustang GT', 'name_ar' => 'موستانج GT'],
            ['brand_id' => 6, 'name' => 'Wrangler Rubicon', 'name_ar' => 'رانجلر روبيكون'],
            ['brand_id' => 7, 'name' => 'Malibu LT', 'name_ar' => 'ماليبو LT'],
            ['brand_id' => 8, 'name' => 'Q5 Premium', 'name_ar' => 'Q5 بريميوم'],
            ['brand_id' => 9, 'name' => '330i', 'name_ar' => '330i'],
        ]);

    }
}
