<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
use App\Events\RideEndEvent;
use App\Models\Ride;
use Illuminate\Http\Request;

class DebugController extends Controller
{
    public function index()
    {
        $ride = Ride::first();
        MyEvent::dispatch($ride);
//        RideEndEvent::dispatch('ssx');
        dd(1);
    }


}
