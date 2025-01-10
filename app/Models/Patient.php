<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'age',
        'Gender',
        'job',
        'phone',
        'address',
        'relation',
        'childerCount',
        'smooking',
        'oldSurgery',
        'alirgy',
        'disease',
        'dite',
        'permenantCure',
        'Cosmetic',
        'CurrentDiseas',
        'imagePath'
    ];

    public function Dept(): BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'patient_depts', 'patient_id', 'dept_id',)->withPivot('id', 'doctor_name', 'illness', 'description', 'cure');
    }

    public function accounter(): HasOne
    {
        return $this->hasOne(Accounter::class);
    }

    public function Field(): BelongsToMany
    {
        return $this->belongsToMany(Field::class, 'patient_fields', 'patient_id', 'field_id');
    }

    public function Lazer(): HasMany
    {
        return $this->hasMany(Lazer::class);
    }

    public function waitingList()
    {
        return $this->belongsToMany(Doctor::class, 'waiting_lists')
            ->withPivot('id', 'expires_at')
            ->withTimestamps();
    }
}
