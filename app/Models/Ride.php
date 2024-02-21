<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Ride extends Model
{
    use HasFactory;

    protected static function booted()
    {
        // Apply a global scope to retrieve rides for the authenticated user only
        static::addGlobalScope('user', function ($query) {
            $userId = Auth::id();
            $user = Auth::user();
            if ($user->hasRole('driver')){
                $query->where('driver_id', $userId);
            }else if ($user->hasRole('user')){
                $query->where('passenger_id', $userId);
            }else if ($user->hasRole('call_center')){
                $query->where('passenger_id', $userId)->OrWhere('user_type','guest_user');
            }
        });
    }

    public function driver()
    {
        return $this->belongsTo(User::class,'driver_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function guest()
    {
        return $this->belongsTo(GuestUser::class,'passenger_id');
    }
}
