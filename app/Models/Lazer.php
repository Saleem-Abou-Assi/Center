<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lazer extends Model
{
    protected $fillable = [
        'patient_id','doctor_id','raysCount','power',
        'speed','pulse','device','point'
    ];


    public function Patient():BelongsTo
    {
    return $this->belongsTo(Patient::class);
    }

    public function Doctor():BelongsTo
    {
    return $this->belongsTo(Doctor::class,'doctor_id');
    }

}
