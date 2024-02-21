<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand_id',
        'vehicle_type_id'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class);
    }


}
