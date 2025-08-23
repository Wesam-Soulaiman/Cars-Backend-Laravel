<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Model as CarModel;
use App\Models\Product;
use App\Models\Store;
use App\Statuses\ProductStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'brand_id' => $idBrand = Brand::inRandomOrder()->first()->id,
            'store_id' => Store::inRandomOrder()->first()->id,
            'model_id' => CarModel::where('brand_id', $idBrand)->inRandomOrder()->first()?->id ?? CarModel::inRandomOrder()->first()?->id,
            'name' => $this->faker->word,
            'main_photo' => 'https://backend.syarti.shop/brand-pmw.jpg',
            'price' => $this->faker->randomFloat(2, 1000, 50000),
            'mileage' => $this->faker->numberBetween(0, 200000),
            'year_of_construction' => $this->faker->year,
            'number_of_seats' => $this->faker->numberBetween(2, 7),
            'drive_type' => $this->faker->randomElement([ProductStatus::DRIVE_FRONT, ProductStatus::DRIVE_REAR]),
            'fuel_type' => $this->faker->randomElement([ProductStatus::FUEL_PETROL, ProductStatus::FUEL_DIESEL, ProductStatus::FUEL_ELECTRIC, ProductStatus::FUEL_HYBRID]),
            'cylinders' => $this->faker->numberBetween(3, 12),
            'cylinder_capacity' => $this->faker->randomFloat(2, 1.0, 6.0),
            'gears' => $this->faker->randomElement([ProductStatus::GEARS_MANUAL, ProductStatus::GEARS_AUTOMATIC]),
            'type' => $this->faker->randomElement([ProductStatus::TYPE_USED, ProductStatus::TYPE_NEW]),
            'seat_type' => $this->faker->randomElement([ProductStatus::SEAT_LEATHER, ProductStatus::SEAT_CLOTH]),
            'sunroof' => $this->faker->boolean,
            'color' => $this->faker->colorName,
            'lights' => $this->faker->word,
        ];
    }
}
