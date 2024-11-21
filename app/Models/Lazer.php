<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lazer extends Model
{
    protected $fillable = [
        'patient_id','doctor_id','raysCount','power',
        'speed','pulse','device','point'
    ];


    public function Patient():HasMany
    {
    return $this->hasMany(Patient::class);
    }

    public function Doctor():HasMany
    {
    return $this->hasMany(Doctor::class);
    }

}
