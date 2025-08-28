<?php

namespace Database\Seeders;

use App\Models\Structure;
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
            [
                'name' => 'Sedan',
                'name_ar' => 'سيدان',
            ],
            [
                'name' => 'Coupe',
                'name_ar' => 'كوبيه',
            ],
            [
                'name' => 'SUV',
                'name_ar' => 'إس يو في',
            ],
            [
                'name' => 'Hatchback',
                'name_ar' => 'هاتشباك',
            ],
            [
                'name' => 'Convertible',
                'name_ar' => 'مكشوفة',
            ],
            [
                'name' => 'Pickup',
                'name_ar' => 'بيك أب',
            ],
        ];

        foreach ($structures as $structure) {
            Structure::create($structure);
        }
    }
}
