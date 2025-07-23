<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_number',
        'floor_number',
        'type',
        'price',
        'amenities',
        'occupancy_limit',
        'status',
        'image',
    ];

    protected $casts = [
        'amenities' => 'array', // Automatically casts JSON to PHP array
        'price' => 'float',
        'occupancy_limit' => 'integer',
        'floor_number' => 'integer',
    ];
}
