<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $governorates = [
            [
                'name' => 'Damascus',
                'name_ar' => 'دمشق',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Aleppo',
                'name_ar' => 'حلب',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Homs',
                'name_ar' => 'حمص',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hama',
                'name_ar' => 'حماة',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Latakia',
                'name_ar' => 'اللاذقية',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Deir ez-Zor',
                'name_ar' => 'دير الزور',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Raqqa',
                'name_ar' => 'الرقة',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Daraa',
                'name_ar' => 'درعا',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Idlib',
                'name_ar' => 'إدلب',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hasakah',
                'name_ar' => 'الحسكة',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tartus',
                'name_ar' => 'طرطوس',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rif Dimashq',
                'name_ar' => 'ريف دمشق',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Quneitra',
                'name_ar' => 'القنيطرة',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Suwayda',
                'name_ar' => 'السويداء',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('governorates')->insert($governorates);
    }
}
