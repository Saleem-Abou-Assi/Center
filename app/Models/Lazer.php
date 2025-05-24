<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Lazer extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'price',
        'real_price',
        'lazer_price',
        'notes',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function Details(): BelongsToMany
    {
        return $this->belongsToMany(LDetails::class, 'lazer_details', 'lazer_id', 'l_details_id');
    }
}
