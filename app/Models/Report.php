<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_type',
        'generated_by',
        'filters',
        'data',
        'file_path',
    ];

    // filters aur data ko JSON me cast karenge
    protected $casts = [
        'filters' => 'array',
        'data' => 'array',
    ];

    // Relationship: Report kis user ne generate kiya
    public function user()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }
}
