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
        $this->call([PermissionSeeder::class, CategoryServiceSeeder::class ,
            BrandSeeder::class, StoreSeeder::class , ModelSeeder::class,
            ServiceSeeder::class , ServiceTypeSeeder::class , ProductSeeder::class ]);
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
    }
}
