<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'raysCount',
        'point',
        'power',
        'speed',
        'pulse',
        'device',
        'doctor_id',
    ];

    public function Doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function Lazers(): BelongsToMany
    {
        return $this->belongsToMany(Lazer::class, 'lazer_details', 'l_details_id', 'lazer_id');
    }
}