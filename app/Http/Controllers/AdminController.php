<?php

namespace App\Http\Controllers;

use App\Models\GuestUser;
use App\Models\User;
use App\Models\Vehicle;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function drivers()
    {
        $drivers = User::with(['vehicles','driverRides'])->whereHas('roles', function ($query) {
            $query->where('name', 'driver');
        })->orderBy('name','asc')->paginate();

        return Inertia::render('DriverList',[
            'data'=>$drivers
        ]);
    }

    public function passengers()
    {
        $passengers = User::with(['passengerRides'])->whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->orderBy('name','asc')->paginate();

        return Inertia::render('PassengerList',[
            'data'=>$passengers
        ]);
    }

    public function guests()
    {
        $passengers = GuestUser::with([])->orderBy('name','asc')->paginate();

        return Inertia::render('GuestList',[
            'data'=>$passengers
        ]);
    }

    public function vehicles()
    {
        $vehicles = Vehicle::with(['brand','model','model.vehicleType'])->orderBy('registration_number','asc')->paginate();

        return Inertia::render('VehicleList',[
            'data'=>$vehicles
        ]);
    }
}
