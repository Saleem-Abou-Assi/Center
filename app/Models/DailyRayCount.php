<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyRayCount extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'ax_start_count',
        'ax_end_count',
        'ay_start_count',
        'ay_end_count',
        'again_start_count',
        'again_end_count',
        'notes'
    ];

    protected $casts = [
        'date' => 'date'
    ];
}
