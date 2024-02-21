<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Database\Factories\VehicleFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AuthSeeder::class);
        $this->call(VehicleTypeSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(VehicleModelSeeder::class);

//        generate users using factory and assign to driver role
        User::factory(100)->create()->each(function ($user) {
            $user->assignRole('driver');
            $vehicle= VehicleFactory::new()->make();
            $user->vehicles()->create($vehicle->getAttributes());
        });
    }
}
