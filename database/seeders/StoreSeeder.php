<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Statuses\StoreStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

                $stores = [
                    [
                        'name' => 'Downtown Gallery',
                        'name_ar' => 'المعرض الداون تاون',
                        'address' => '123 Main Street, Downtown',
                        'address_ar' => '123 الشارع الرئيسي، الداون تاون',
                        'email' => 'downtown@gallery.com',
                        'password' => Hash::make('password123'),
                        'photo' => 'stores/downtown.jpg',
                        'phone' => '+1234567890',
                        'whatsapp_phone' => '+1234567890',
                        'latitude' => 40.712776,
                        'longitude' => -74.005974,
                        'active' => true,
                        'premium' => true,
                        'type' => StoreStatus::GALLERY,
                    ],
                    [
                        'name' => 'City Center Office',
                        'name_ar' => 'مكتب وسط المدينة',
                        'address' => '456 Business District, City Center',
                        'address_ar' => '456 منطقة الأعمال، وسط المدينة',
                        'email' => 'office@citycenter.com',
                        'password' => Hash::make('officepass456'),
                        'photo' => 'stores/office1.jpg',
                        'phone' => '+0987654321',
                        'whatsapp_phone' => '+0987654321',
                        'latitude' => 40.758899,
                        'longitude' => -73.987319,
                        'active' => true,
                        'premium' => false,
                        'type' => StoreStatus::OFFICE,
                    ],
                    [
                        'name' => 'Artisan Gallery',
                        'name_ar' => 'معرض الحرفيين',
                        'address' => '789 Art District, Cultural Area',
                        'address_ar' => '789 منطقة الفنون، المنطقة الثقافية',
                        'email' => 'artisan@gallery.com',
                        'password' => Hash::make('artpass789'),
                        'photo' => 'stores/artisan.jpg',
                        'phone' => '+1122334455',
                        'whatsapp_phone' => '+1122334455',
                        'latitude' => 40.750504,
                        'longitude' => -73.993439,
                        'active' => true,
                        'premium' => true,
                        'type' => StoreStatus::GALLERY,
                    ],
                    [
                        'name' => 'Business Solutions Office',
                        'name_ar' => 'مكتب حلول الأعمال',
                        'address' => '321 Corporate Avenue, Business Park',
                        'address_ar' => '321 جادة الشركات، مجمع الأعمال',
                        'email' => 'business@solutions.com',
                        'password' => Hash::make('businesspass321'),
                        'photo' => 'stores/business.jpg',
                        'phone' => '+5566778899',
                        'whatsapp_phone' => '+5566778899',
                        'latitude' => 40.741444,
                        'longitude' => -73.989953,
                        'active' => false, // Inactive store
                        'premium' => false,
                        'type' => StoreStatus::OFFICE,
                    ],
                    [
                        'name' => 'Luxury Gallery',
                        'name_ar' => 'المعرض الفاخر',
                        'address' => '555 Premium Street, Luxury District',
                        'address_ar' => '555 شارع البريميوم، المنطقة الفاخرة',
                        'email' => 'luxury@gallery.com',
                        'password' => Hash::make('luxurypass555'),
                        'photo' => 'stores/luxury.jpg',
                        'phone' => '+4455667788',
                        'whatsapp_phone' => '+4455667788',
                        'latitude' => 40.768999,
                        'longitude' => -73.981888,
                        'active' => true,
                        'premium' => true,
                        'type' => StoreStatus::GALLERY,
                    ]
                ];

                foreach ($stores as $store) {
                    DB::table('stores')->insert(array_merge($store, [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]));
                }

    }
}
