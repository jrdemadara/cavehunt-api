<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NearbyAmenities extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'nearby_amenities',
        'distance',
    ];

}
