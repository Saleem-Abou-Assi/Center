<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Depends;

class Doctor extends Model
{
    protected $fillable = [
        'user_id','phone','address','specialization','dept_id'
    ];
 
    public function User():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function Dept() : BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function PatientDept() : BelongsTo
    {
        return $this->belongsTo(PatientDept::class);
    }

    public function Accounter():HasOne
    {
        return $this->hasOne(Accounter::class);
    }
    
    public function APD():HasMany
    {
        return $this->hasMany(APD::class);
    }

    public function Lazer():HasOne
    {
        return $this->hasOne(LDetails::class);
    }

    public function waitingList()
    {
        return $this->belongsToMany(Patient::class, 'waiting_lists')
        ->withPivot('id','expires_at')
        ->withTimestamps();
    }

    public function apd_storage():HasMany
    {
        return $this->hasMany(ApdStorage::class);
    }
}
