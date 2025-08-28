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
            'category_service_id' => 1, // subscription
            'has_top_result' => true,
            'services' => ['sale', 'rent', 'parts'],
            'count_product' => 10,
            'count_days' => 30,
        ]);

        Service::create([
            'name' => 'Premium Sale',
            'name_ar' => 'بيع مميز',
            'description' => 'Premium service for selling cars with priority listing.',
            'description_ar' => 'خدمة مميزة لبيع السيارات مع قائمة ذات أولوية.',
            'category_service_id' => 1, // subscription
            'has_top_result' => true,
            'services' => ['sale'],
            'count_product' => 20,
            'count_days' => 60,
        ]);

        Service::create([
            'name' => 'Rental Package',
            'name_ar' => 'باقة التأجير',
            'description' => 'Service for renting cars with extended duration.',
            'description_ar' => 'خدمة لتأجير السيارات مع مدة ممتدة.',
            'category_service_id' => 1, // subscription
            'has_top_result' => false,
            'services' => ['rent'],
            'count_product' => 15,
            'count_days' => 90,
        ]);

        Service::create([
            'name' => 'Parts Promotion',
            'name_ar' => 'ترويج قطع الغيار',
            'description' => 'Promotional service for car parts with limited slots.',
            'description_ar' => 'خدمة ترويجية لقطع غيار السيارات مع فتحات محدودة.',
            'category_service_id' => 2, // limit
            'has_top_result' => false,
            'services' => ['parts'],
            'count_product' => 5,
            'count_days' => 15,
        ]);

        Service::create([
            'name' => 'Elite Showcase',
            'name_ar' => 'عرض النخبة',
            'description' => 'Elite service for top-tier car sales and rentals with top result priority.',
            'description_ar' => 'خدمة النخبة لبيع وتأجير السيارات مع أولوية النتائج العليا.',
            'category_service_id' => 1, // subscription
            'has_top_result' => true,
            'services' => ['sale', 'rent'],
            'count_product' => 25,
            'count_days' => 45,
        ]);

        Service::create([
            'name' => 'Basic Parts Listing',
            'name_ar' => 'قائمة قطع الغيار الأساسية',
            'description' => 'Basic listing service for car parts with limited visibility.',
            'description_ar' => 'خدمة قائمة أساسية لقطع غيار السيارات مع رؤية محدودة.',
            'category_service_id' => 2, // limit
            'has_top_result' => false,
            'services' => ['parts'],
            'count_product' => 8,
            'count_days' => 30,
        ]);


    }
}
