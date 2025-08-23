<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $structures = [
            ['id' => 1, 'name' => 'Sedan'],
            ['id' => 2, 'name' => 'SUV'],
            ['id' => 3, 'name' => 'Truck'],
            ['id' => 4, 'name' => 'Coupe'],
            ['id' => 5, 'name' => 'Convertible'],
            ['id' => 6, 'name' => 'Station'],
            ['id' => 7, 'name' => 'HatchBack'],
            ['id' => 8, 'name' => 'Van'],

        ];

        DB::table('structures')->insert($structures);
    }
}
