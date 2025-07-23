<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'address',
        'gender',
        'date_of_birth',
        'nationality',
        'id_type',
        'id_document_path',
        'profile_image',
        'emergency_contact',
        'notes',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'is_blacklisted' => 'boolean',
    ];
}
