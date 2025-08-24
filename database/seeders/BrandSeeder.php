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
            ['name' => 'Honda', 'name_ar' => 'هوندا', 'logo' => 'brand-honda.jpg'],
            ['name' => 'Tesla', 'name_ar' => 'تيسلا', 'logo' => 'brand-tesla.jpg'],
            ['name' => 'Toyota', 'name_ar' => 'تويوتا', 'logo' => 'brand-toyota.jpg'],
            ['name' => 'Nissan', 'name_ar' => 'نيسان', 'logo' => 'brand-nissan.jpg'],
            ['name' => 'Ford', 'name_ar' => 'فورد', 'logo' => 'brand-ford.jpg'],
            ['name' => 'Jeep', 'name_ar' => 'جيب', 'logo' => 'brand-jeep.jpg'],
            ['name' => 'Chevrolet', 'name_ar' => 'شفروليه', 'logo' => 'brand-chevrolet.jpg'],
            ['name' => 'Audi', 'name_ar' => 'أودي', 'logo' => 'brand-audi.jpg'],
            ['name' => 'BMW', 'name_ar' => 'بي إم دبليو', 'logo' => 'brand-bmw.jpg'],
            ['name' => 'Mercedes-Benz', 'name_ar' => 'مرسيدس بنز', 'logo' => 'brand-mercedes.jpg'],
            ['name' => 'Hyundai', 'name_ar' => 'هيونداي', 'logo' => 'brand-hyundai.jpg'],
            ['name' => 'Kia', 'name_ar' => 'كيا', 'logo' => 'brand-kia.jpg'],
            ['name' => 'Volkswagen', 'name_ar' => 'فولكس فاجن', 'logo' => 'brand-volkswagen.jpg'],
            ['name' => 'Mitsubishi', 'name_ar' => 'ميتسوبيشي', 'logo' => 'brand-mitsubishi.jpg'],
            ['name' => 'Lexus', 'name_ar' => 'لكزس', 'logo' => 'brand-lexus.jpg'],
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->insert(array_merge($brand, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
