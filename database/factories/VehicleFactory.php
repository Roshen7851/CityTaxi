<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\User;
use App\Models\VehicleModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::pluck('id')->random(),
            'brand_id' => Brand::pluck('id')->random(),
            'model_id' => VehicleModel::pluck('id')->random(),
            'manufactured_year' => rand(2000, 2022),
            'registered_year' => rand(2000, 2022),
            'registration_number' => $this->faker->regexify('[A-Z]{2,3}-[0-9]{4}'),
            'color' => $this->faker->randomElement(['Red', 'Blue', 'Green', 'Yellow', 'Black']),
        ];
    }
}
