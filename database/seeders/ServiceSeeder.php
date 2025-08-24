<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'name' => 'Search Result',
            'name_ar' => 'نتائج البحث',
            'description' => 'A Search-Result website.',
            'description_ar' => 'موقع ويب لنتائج البحث.',
            'category_service_id' => 1,
            'active' => true,
        ]);

    }
}
