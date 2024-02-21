<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'brand_id',
        'model_id',
        'manufactured_year',
        'registered_year',
        'registration_number',
        'color',
        'vehicle_license',
        'vehicle_insurance',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function model()
    {
        return $this->belongsTo(VehicleModel::class,'model_id');
    }




}
