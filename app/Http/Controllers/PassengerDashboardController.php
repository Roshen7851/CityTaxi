<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PassengerDashboardController extends Controller
{

    public function index()
    {
        $drivers = User::with(['vehicles','vehicles.model','vehicles.model.vehicleType','vehicles.brand'])->whereHas('roles', function ($q) {
            $q->where('name', 'driver');
        })->get();

        return Inertia::render('Dashboard',
            [
                'drivers' => $drivers,
                'greeting' => $this->greet(),
            ]
        );
    }

    public function CallCenterDashboard()
    {
        $drivers = User::with(['vehicles','vehicles.model','vehicles.model.vehicleType','vehicles.brand'])->whereHas('roles', function ($q) {
            $q->where('name', 'driver');
        })->get();

        return Inertia::render('CallCenterDashboard',
            ['drivers' => $drivers,
                'greeting' => $this->greet(),]
        );
    }

    private function greet()
    {
        // Get the current time using CarbonA
        $currentTime = Carbon::now();

        // Set the default greeting
        $greeting = 'Hello!';

        // Determine the appropriate greeting based on the current time
        if ($currentTime->hour < 12) {
            $greeting = 'Good Morning!';
        } elseif ($currentTime->hour < 18) {
            $greeting = 'Good Afternoon!';
        } else {
            $greeting = 'Good Evening!';
        }

        return $greeting;
    }
}
