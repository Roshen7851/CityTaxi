<?php

namespace Database\Seeders;

use App\Models\VehicleType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VehicleType::updateOrCreate(['id' => 1],[
            'name' => 'Moto',
            'base_price' => 100,
            'price_per_km' => 50,
            'passenger_count' => 1,
        ]);

        VehicleType::updateOrCreate(['id' => 2],[
            'name' => 'CityTaxi Tuk',
            'base_price' => 150,
            'price_per_km' => 60,
            'passenger_count' => 3,
        ]);

        VehicleType::updateOrCreate(['id' => 3],[
            'name' => 'Zip',
            'base_price' => 180,
            'price_per_km' => 80,
            'passenger_count' => 4,
        ]);

        VehicleType::updateOrCreate(['id' => 4],[
            'name' => 'CityTaxi XL',
            'base_price' => 200,
            'price_per_km' => 100,
            'passenger_count' => 6,
        ]);
    }
}
