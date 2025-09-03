<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoreTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $storeTypes = [
            [
                'name' => 'Car Dealership',
                'name_ar' => 'وكالة سيارات',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Auto Parts',
                'name_ar' => 'قطع غيار سيارات',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Car Rental Agency',
                'name_ar' => 'وكالة تأجير سيارات',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        DB::table('store_types')->insert($storeTypes);
    }
}
