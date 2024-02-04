<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewDriver implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'max:10', 'min:10'],
            'address' => ['required'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
//            'driving_license_front' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
//            'driving_license_back' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'brand' => 'required',
            'model' => 'required',
            'manufactured_year' => ['required', 'max:4', 'min:4', 'before:'.date('Y'), 'after:1900'],
            'registered_year' => ['required', 'max:4', 'min:4', 'after:manufactured_year', 'before:'.date('Y')],
            'registration_number' => ['required','max:8','min:7','unique:vehicles','regex:/^[A-Z]{2,3}-\d{4}$/'],
            'color' => 'required',
//            'vehicle_license' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
//            'vehicle_insurance' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'phone' => $input['phone'],
            'address' => $input['address'],
        ]);

//        asign to driver role
        $user->assignRole('driver');

        Vehicle::create([
            'user_id' => $user->id,
            'brand' => $input['brand'],
            'model' => $input['model'],
            'manufactured_year' => $input['manufactured_year'],
            'registered_year' => $input['registered_year'],
            'registration_number' => $input['registration_number'],
            'color' => $input['color'],
//            'vehicle_license' => $input['vehicle_license']->store('public'),
//            'vehicle_insurance' => $input['vehicle_insurance']->store('public'),
        ]);

        return $user;

    }
}
