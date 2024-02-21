<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::updateOrCreate(['title' => 'Toyota']);
        Brand::updateOrCreate(['title' => 'Bajaj']);
        Brand::updateOrCreate(['title' => 'TVS']);
        Brand::updateOrCreate(['title' => 'Honda']);
        Brand::updateOrCreate(['title' => 'Suzuki']);
        Brand::updateOrCreate(['title' => 'Nissan']);
    }
}
