<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lazer extends Model
{
    protected $fillable = [
        'patient_id','doctor_id','real_price','lazer_price','notes','price'
    ];


    public function Patient():BelongsTo
    {
    return $this->belongsTo(Patient::class);
    }

    public function Doctor():BelongsTo
    {
    return $this->belongsTo(Doctor::class,'doctor_id');
    }

    public function Details():BelongsToMany
    {
        return $this->belongsToMany(LDetails::class,'lazer_details','lazer_id','l_details_id');
    }

}
