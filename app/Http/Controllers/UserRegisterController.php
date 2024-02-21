<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewDriver;
use App\Actions\Fortify\CreateNewPassenger;
use App\Models\Brand;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

class UserRegisterController extends RegisteredUserController
{
    public function registerDriver(Request $request,
                                   CreateNewDriver $creator): RegisterResponse
    {
        if (config('fortify.lowercase_usernames')) {
            $request->merge([
                Fortify::username() => Str::lower($request->{Fortify::username()}),
            ]);
        }

        event(new Registered($user = $creator->create($request->all())));

        $this->guard->login($user);
        return app(RegisterResponse::class);
    }

    public function registerPassenger(Request $request,
                                      CreateNewPassenger $creator): RegisterResponse
    {
        if (config('fortify.lowercase_usernames')) {
            $request->merge([
                Fortify::username() => Str::lower($request->{Fortify::username()}),
            ]);
        }

        event(new Registered($user = $creator->create($request->all())));

        $this->guard->login($user);

        return app(RegisterResponse::class);
    }


    public function registerDriverView(){
        $brands = Brand::get();
        $models = VehicleModel::get();
        $types = VehicleType::get();
        return Inertia::render('Auth/RegisterDriver',[
            'brands' => $brands,
            'models' => $models,
            'types' => $types
        ]);
    }

}
