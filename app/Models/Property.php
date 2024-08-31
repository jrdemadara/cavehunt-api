<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'capacity',
        'bedroom',
        'has_kitchen',
        'has_bathroom',
        'has_laundry_area',
        'has_living_room',
        'has_lobby',
        'has_parking',
        'has_yard',
        'has_balcony',
        'has_terrace',
        'has_cctv',
        'has_electric_meter',
        'has_water_meter',
        'is_gated',
        'curfew_hour',
        'price',
        'advance_payment',
        'security_deposit',
        'address',
        'latitude',
        'longitude',
        'available_at',
    ];

}
