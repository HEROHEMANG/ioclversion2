<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JourneyRoute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'source',
        'destination',
        'start_coords',
        'end_coords',
        'risk_points',
        'crowded_spots',
        'emergency_locations',
    ];

    protected $casts = [
        'start_coords' => 'array',
        'end_coords' => 'array',
        'risk_points' => 'array',
        'crowded_spots' => 'array',
        'emergency_locations' => 'array',
    ];
}


