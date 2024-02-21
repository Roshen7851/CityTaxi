<?php

namespace Database\Seeders;

use App\Models\VehicleModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        5 bajaj models
        VehicleModel::updateOrCreate(['title' => 'Pulsar 150'], ['brand_id' => 2, 'vehicle_type_id' => 1]);
        VehicleModel::updateOrCreate(['title' => 'Pulsar 180'], ['brand_id' => 2, 'vehicle_type_id' => 1]);
        VehicleModel::updateOrCreate(['title' => 'Pulsar 220'], ['brand_id' => 2, 'vehicle_type_id' => 1]);
        VehicleModel::updateOrCreate(['title' => 'Platina'], ['brand_id' => 2, 'vehicle_type_id' => 1]);
        VehicleModel::updateOrCreate(['title' => 'Discover 125'], ['brand_id' => 2, 'vehicle_type_id' => 1]);

//        5 tuk models
        VehicleModel::updateOrCreate(['title' => 'TVS King'], ['brand_id' => 3, 'vehicle_type_id' => 2]);
        VehicleModel::updateOrCreate(['title' => 'Bajaj RE'], ['brand_id' => 2, 'vehicle_type_id' => 2]);
        VehicleModel::updateOrCreate(['title' => 'Bajaj Maxima'], ['brand_id' => 2, 'vehicle_type_id' => 2]);
        VehicleModel::updateOrCreate(['title' => 'Bajaj Compact'], ['brand_id' => 2, 'vehicle_type_id' => 2]);
        VehicleModel::updateOrCreate(['title' => 'Bajaj Compact 4S'], ['brand_id' => 2, 'vehicle_type_id' => 2]);

//        5 suzuki cars
        VehicleModel::updateOrCreate(['title' => 'Alto 800'], ['brand_id' => 5, 'vehicle_type_id' => 3]);
        VehicleModel::updateOrCreate(['title' => 'Alto K10'], ['brand_id' => 5, 'vehicle_type_id' => 3]);
        VehicleModel::updateOrCreate(['title' => 'Celerio'], ['brand_id' => 5, 'vehicle_type_id' => 3]);
        VehicleModel::updateOrCreate(['title' => 'Swift'], ['brand_id' => 5, 'vehicle_type_id' => 3]);
        VehicleModel::updateOrCreate(['title' => 'Dzire'], ['brand_id' => 5, 'vehicle_type_id' => 3]);

//        5 toyota cars for 4 passenger
        VehicleModel::updateOrCreate(['title' => 'Etios Liva'], ['brand_id' => 1, 'vehicle_type_id' => 3]);
        VehicleModel::updateOrCreate(['title' => 'Etios'], ['brand_id' => 1, 'vehicle_type_id' => 3]);
        VehicleModel::updateOrCreate(['title' => 'Yaris'], ['brand_id' => 1, 'vehicle_type_id' => 3]);
        VehicleModel::updateOrCreate(['title' => 'Corolla'], ['brand_id' => 1, 'vehicle_type_id' => 3]);
        VehicleModel::updateOrCreate(['title' => 'Camry'], ['brand_id' => 1, 'vehicle_type_id' => 3]);

//        5 toyota cars for 6 passenger
        VehicleModel::updateOrCreate(['title' => 'Innova Crysta'], ['brand_id' => 1, 'vehicle_type_id' => 4]);
        VehicleModel::updateOrCreate(['title' => 'Innova'], ['brand_id' => 1, 'vehicle_type_id' => 4]);
        VehicleModel::updateOrCreate(['title' => 'Fortuner'], ['brand_id' => 1, 'vehicle_type_id' => 4]);
        VehicleModel::updateOrCreate(['title' => 'Land Cruiser'], ['brand_id' => 1, 'vehicle_type_id' => 4]);
        VehicleModel::updateOrCreate(['title' => 'Land Cruiser Prado'], ['brand_id' => 1, 'vehicle_type_id' => 4]);

//        5 honda cars for 4 passenger
        VehicleModel::updateOrCreate(['title' => 'Brio'], ['brand_id' => 4, 'vehicle_type_id' => 3]);
        VehicleModel::updateOrCreate(['title' => 'Amaze'], ['brand_id' => 4, 'vehicle_type_id' => 3]);
        VehicleModel::updateOrCreate(['title' => 'City'], ['brand_id' => 4, 'vehicle_type_id' => 3]);
        VehicleModel::updateOrCreate(['title' => 'Civic'], ['brand_id' => 4, 'vehicle_type_id' => 3]);
        VehicleModel::updateOrCreate(['title' => 'Accord'], ['brand_id' => 4, 'vehicle_type_id' => 3]);

//        5 honda cars for 6 passenger
        VehicleModel::updateOrCreate(['title' => 'BR-V'], ['brand_id' => 4, 'vehicle_type_id' => 4]);
        VehicleModel::updateOrCreate(['title' => 'WR-V'], ['brand_id' => 4, 'vehicle_type_id' => 4]);
        VehicleModel::updateOrCreate(['title' => 'CR-V'], ['brand_id' => 4, 'vehicle_type_id' => 4]);
        VehicleModel::updateOrCreate(['title' => 'HR-V'], ['brand_id' => 4, 'vehicle_type_id' => 4]);
        VehicleModel::updateOrCreate(['title' => 'Mobilio'], ['brand_id' => 4, 'vehicle_type_id' => 4]);

//        5 nissan cars for 4 passenger
        VehicleModel::updateOrCreate(['title' => 'Micra'], ['brand_id' => 6, 'vehicle_type_id' => 3]);
        VehicleModel::updateOrCreate(['title' => 'Sunny'], ['brand_id' => 6, 'vehicle_type_id' => 3]);
        VehicleModel::updateOrCreate(['title' => 'Kicks'], ['brand_id' => 6, 'vehicle_type_id' => 3]);
        VehicleModel::updateOrCreate(['title' => 'Terrano'], ['brand_id' => 6, 'vehicle_type_id' => 3]);
        VehicleModel::updateOrCreate(['title' => 'Teana'], ['brand_id' => 6, 'vehicle_type_id' => 3]);

//        5 nissan cars for 6 passenger
        VehicleModel::updateOrCreate(['title' => 'Evalia'], ['brand_id' => 6, 'vehicle_type_id' => 4]);
        VehicleModel::updateOrCreate(['title' => 'X-Trail'], ['brand_id' => 6, 'vehicle_type_id' => 4]);
        VehicleModel::updateOrCreate(['title' => 'Patrol'], ['brand_id' => 6, 'vehicle_type_id' => 4]);
        VehicleModel::updateOrCreate(['title' => 'GT-R'], ['brand_id' => 6, 'vehicle_type_id' => 4]);
        VehicleModel::updateOrCreate(['title' => '370Z'], ['brand_id' => 6, 'vehicle_type_id' => 4]);

    }
}
