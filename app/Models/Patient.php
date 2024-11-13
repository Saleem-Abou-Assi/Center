<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Patient extends Model
{
    protected $fillable = [
        'name','phone','address','Gender','age'
    ];

    public function Dept(): BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'patient_depts', 'patient_id', 'dept_id',)->withPivot('id','doctor_name', 'illness', 'description', 'cure');
    }

    public function accounter(): HasOne
    {
        return $this->hasOne(Accounter::class);
    }
}
