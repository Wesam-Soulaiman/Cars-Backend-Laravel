<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Brand;
use App\Models\Model;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // \App\Models\User::factory(10)->create();
        //        Store::factory(10)->create();
        //        Brand::factory(50)->create();
        //        Model::factory(80)->create();
        //        Product::factory(200)->create();
        //        $this->call([BrandSeeder::class, ModelSeeder::class]);
        //        $this->call([StructureSeeder::class, ServiceSeeder::class, ServiceTypeSeeder::class]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call([
            PermissionSeeder::class,
            CategoryServiceSeeder::class,
            ServiceSeeder::class,
            BrandSeeder::class, // Assumed for products.brand_id
            StructureSeeder::class,
            GovernorateSeeder::class,
            StoreTypeSeeder::class,
            StoreSeeder::class,
            ModelSeeder::class,
            ColorSeeder::class,
            FuelTypeSeeder::class,
            GearSeeder::class,
            LightSeeder::class,
            DealSeeder::class,
            CarPartCategorySeeder::class,
            CarPartSeeder::class,
        ]);

        // Call new seeders
        $this->call([
            ProductSeeder::class,
            FeatureSeeder::class,
            ProductFeatureSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
