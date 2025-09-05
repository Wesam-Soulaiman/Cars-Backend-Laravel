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
        $brands = [
            ['name' => 'Honda', 'name_ar' => 'هوندا', 'logo' => '/asset/brand/pmw.jpg'],
            ['name' => 'Tesla', 'name_ar' => 'تيسلا', 'logo' => '/asset/brand/pmw.jpg'],
            ['name' => 'Toyota', 'name_ar' => 'تويوتا', 'logo' => '/asset/brand/pmw.jpg'],
            ['name' => 'Nissan', 'name_ar' => 'نيسان', 'logo' => '/asset/brand/pmw.jpg'],
            ['name' => 'Ford', 'name_ar' => 'فورد', 'logo' => '/asset/brand/pmw.jpg'],
            ['name' => 'Jeep', 'name_ar' => 'جيب', 'logo' => '/asset/brand/pmw.jpg'],
            ['name' => 'Chevrolet', 'name_ar' => 'شفروليه', 'logo' => '/asset/brand/pmw.jpg'],
            ['name' => 'Audi', 'name_ar' => 'أودي', 'logo' => '/asset/brand/pmw.jpg'],
            ['name' => 'BMW', 'name_ar' => 'بي إم دبليو', 'logo' => '/asset/brand/pmw.jpg'],
            ['name' => 'Mercedes-Benz', 'name_ar' => 'مرسيدس بنز', 'logo' => '/asset/brand/pmw.jpg'],
            ['name' => 'Hyundai', 'name_ar' => 'هيونداي', 'logo' => '/asset/brand/pmw.jpg'],
            ['name' => 'Kia', 'name_ar' => 'كيا', 'logo' => '/asset/brand/pmw.jpg'],
            ['name' => 'Volkswagen', 'name_ar' => 'فولكس فاجن', 'logo' => '/asset/brand/pmw.jpg'],
            ['name' => 'Mitsubishi', 'name_ar' => 'ميتسوبيشي', 'logo' => '/asset/brand/pmw.jpg'],
            ['name' => 'Lexus', 'name_ar' => 'لكزس', 'logo' => '/asset/brand/pmw.jpg'],
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->insert(array_merge($brand, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
