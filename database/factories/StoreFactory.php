<?php

namespace Database\Factories;

use App\Models\Store;
use App\Statuses\StoreStatus; // Ensure this namespace is correct for StoreStatus
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Store::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'address' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'photo' => $this->faker->imageUrl(640, 480, 'business', true, 'store'),
            'phone' => $this->faker->phoneNumber(),
            'whatsapp_phone' => $this->faker->phoneNumber(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'active' => $this->faker->boolean(80),
            'premium' => $this->faker->boolean(20),
            'type' => $this->faker->randomElement([StoreStatus::GALLERY, StoreStatus::OFFICE]),
        ];
    }
}
