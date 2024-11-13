<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Department extends Model
{
    protected $fillable = [
        'title'
    ];

    
    public function Patient(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class,PatientDept::class)->withPivot('doctor_name','illness','description','cure');
    }

    
    public function Doctor() :HasOne
    {
        return $this->hasOne(Doctor::class);
    }
}

