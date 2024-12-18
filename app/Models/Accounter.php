<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Accounter extends Model
{
    protected $fillable = [
        'patient_id'
    ];
  
    public function patient():BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
    public function Doctor():BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function PatientDept(): BelongsToMany
    {
        return $this->belongsToMany(PatientDept::class, 'patient_dept_accounter', 'A_id', 'PD_id')
        ->withPivot('doctor_id', 'check_in_type', 'given_cure', 'status');
    }
    
}
