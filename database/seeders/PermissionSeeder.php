<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Stores
            'stores.view',
            'stores.create',
            'stores.update',
            'stores.delete',

            // Brands
            'brands.view',
            'brands.create',
            'brands.update',
            'brands.delete',

            // Models
            'models.view',
            'models.create',
            'models.update',
            'models.delete',

            // Products
            'products.view',
            'products.create',
            'products.update',
            'products.delete',

            // Offers
            'offers.view',
            'offers.create',
            'offers.update',
            'offers.delete',

            // Services
            'services.view',
            'services.create',
            'services.update',
            'services.delete',
            'services.categories.view',

            // Orders
            'orders.view',
            'orders.create',
            'orders.update',
            'orders.delete',

            // Roles
            'roles.view',
            'roles.create',
            'roles.update',
            'roles.delete',

            // Employees
            'employees.view',
            'employees.create',
            'employees.update',
            'employees.delete',
            // Banners
            'banners.view',
            'banners.create',
            'banners.update',
            'banners.delete',

            // FAQ
            'FAQ.view',
            'FAQ.create',
            'FAQ.update',
            'FAQ.delete',
            // Feature
            'feature.view',
            'feature.create',
            'feature.update',
            'feature.delete',


            // Car Part Category
            'car_part_categories.view',
            'car_part_categories.create',
            'car_part_categories.update',
            'car_part_categories.delete',

            // Car Part Category
            'car_part.view',
            'car_part.create',
            'car_part.update',
            'car_part.delete',

            // Car Part Category
            'color.view',
            'color.create',
            'color.update',
            'color.delete',

            // fuel type
            'fuel_type.view',
            'fuel_type.create',
            'fuel_type.update',
            'fuel_type.delete',

            //gear
            'gear.view',
            'gear.create',
            'gear.update',
            'gear.delete',

            //light
            'light.view',
            'light.create',
            'light.update',
            'light.delete',

            //structure
            'structure.view',
            'structure.create',
            'structure.update',
            'structure.delete',


            'rent_category.view',
            // Authentication / Dashboard
            'dashboard.access',
        ];

        $permissionIds = [];

        foreach ($permissions as $permission) {
            $id = DB::table('permissions')->insertGetId([
                'guard_name' => $permission,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $permissionIds[] = $id;
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin' , 'name_ar' =>'ادمن']);

        foreach ($permissionIds as $permissionId) {
            DB::table('role_permissions')->insert([
                'role_id' => $adminRole->id,
                'permission_id' => $permissionId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        Employee::create(['name' => 'admin','name_ar'=>'ادمن', 'role_id' => $adminRole->id, 'email' => 'admin@gmail.com','phone'=>'0987654321', 'password' => Hash::make(12345678)]);
    }
}
