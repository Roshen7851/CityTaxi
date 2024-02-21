<?php

namespace App\Http\Controllers;

use App\Events\PaymentDone;
use App\Events\RideEndEvent;
use App\Models\GuestUser;
use App\Models\Ride;
use App\Models\RideRating;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RideController extends Controller
{

    public function index()
    {
        $rides = Ride::with(['vehicle','driver','vehicle.brand','vehicle.model','guest'])->get();
        return Inertia::render('PassengerTrips',[
            'rides'=>$rides
        ]);
    }

    public function store(Request $request)
    {
        $driver = $request->driver;
        $guestFlag = false;
        $guest = null;

        if (!empty($request->guest_data)){
            $guestUser = $request->guest_data;
            $guest = new GuestUser();
            $guest->name = $guestUser['name'];
            $guest->email = $guestUser['email'];
            $guest->phone = $guestUser['phone'];
            $guestFlag=true;
            $guest->save();
        }

        $ride = new Ride();
        $ride->driver_id = $driver['id'];
        $ride->passenger_id = $guestFlag?$guest->id:$request->passenger_id;
        $ride->user_type = $guestFlag ? 'guest_user': 'user';
        $ride->vehicle_id = $request->vehicle_id;
        $ride->start_location = $request->start_location;
        $ride->end_location = $request->end_location;
        $ride->distance = $request->distance;
        $ride->duration = $request->duration;
        $ride->arrived_at = Carbon::parse($request->arrived_at);
        $ride->base_fare = $request->base_fare;
        $ride->distance_fare = $request->distance_fare;
        $ride->total = $request->total;
        $ride->save();

        return redirect(route('ride.ongoing', $ride->id));

    }

    public function ongoing(Request $request, Ride $ride)
    {
//        dd($ride->status);
//        if ($ride->status != 'pending') {
//            return redirect()->route('ride.list');
//        }


        return Inertia::render('ActiveRide', [
            'greeting' => $this->greet(),
            'ride' => $ride,
            'driver' => $ride->driver,
            'vehicle' => $ride->vehicle,
            'vehicleModel' => $ride->vehicle->model,
            'vehicleBrand' => $ride->vehicle->brand,
            'vehicleType' => $ride->vehicle->model->vehicleType
        ]);
    }

    public function cancelRide(Request $request)
    {
        $rideId = $request->ride_id;
        $ride = Ride::find($rideId);
        $ride->status = 'cancelled';
        $ride->save();

        return redirect(route('ride.list'));
    }

    private function greet()
    {
        // Get the current time using Carbon
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

    public function payment(Request $request)
    {
        $rideId = $request->ride_id;
        $ride = Ride::find($rideId);
        $ride->status = 'paid';
        $ride->payment_status = 'paid';
        $ride->save();

        PaymentDone::dispatch($ride);
        return redirect(route('ride.review',$ride->id,));

    }


    public function review(Request $request, Ride $ride)
    {
//        dd($ride->status);
        if ($ride->status != 'paid') {
            return redirect()->route('ride.list');
        }


        return Inertia::render('RideRating', [
            'greeting' => $this->greet(),
            'ride' => $ride,
            'driver' => $ride->driver,
            'vehicle' => $ride->vehicle,
            'vehicleModel' => $ride->vehicle->model,
            'vehicleBrand' => $ride->vehicle->brand,
            'vehicleType' => $ride->vehicle->model->vehicleType
        ]);
    }

    public function rateNow(Request $request)
    {
        $rideId = $request->ride_id;
        $ride = Ride::find($rideId);
        $ride->status = 'reviewed';
        $ride->save();


        $rate = new RideRating();
        $rate->driver_id = $request->driver_id;
        $rate->ride_id = $request->ride_id;
        $rate->rating_score = $request->rating_score;
        $rate->passenger_id = $request->passenger_id;
        $rate->comment = $request->comment;
        $rate->save();

        return redirect()->route('ride.list');

    }


    public function rideAccept(Request $request)
    {
        $rideId = $request->ride_id;
        $ride = Ride::find($rideId);
        $ride->status = 'accepted';
        $ride->save();

        return redirect()->route('ride.ongoing',$ride->id);
    }

    public function rideReject(Request $request)
    {
        $rideId = $request->ride_id;
        $ride = Ride::find($rideId);
        $ride->status = 'rejected';
        $ride->save();

        return redirect()->route('ride.list');
    }

    public function requestPayment(Request $request)
    {
        $rideId = $request->ride_id;
        $ride = Ride::find($rideId);
        RideEndEvent::dispatch($ride);
        $ride->save();
    }
}
