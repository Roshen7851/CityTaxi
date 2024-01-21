<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::updateOrCreate(['name' => 'admin'], [
            'guard_name' => 'web',
        ]);

        $callCenterRole = Role::updateOrCreate(['name' => 'call_center'], [
            'guard_name' => 'web',
        ]);

        $driverRole = Role::updateOrCreate(['name' => 'driver'], [
            'guard_name' => 'web',
        ]);

        $userRole = Role::updateOrCreate(['name' => 'user'], [
            'guard_name' => 'web',
        ]);


//        create admin user
        $admin = User::updateOrCreate(
            [
                'email' => 'admin@test.com'
            ],
            [
                'name' => 'admin',
                'password' => Hash::make('test1234'),
            ]);

        $admin->assignRole($adminRole);

//        create call center user
        $callCenter = User::updateOrCreate(
            [
                'email' => 'callcenter@test.com'
            ],
            [
                'name' => 'call_center',
                'password' => Hash::make('test1234'),
            ]);
        $callCenter->assignRole($callCenterRole);
    }
}
