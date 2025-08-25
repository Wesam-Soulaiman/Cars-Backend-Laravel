<?php

namespace Database\Seeders;

use App\Models\CategoryService;
use Illuminate\Database\Seeder;

class CategoryServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryService::create(['name' => 'subscription']);
        CategoryService::create(['name' => 'limit']);

    }
}
