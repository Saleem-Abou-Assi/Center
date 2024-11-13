<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Depends;

class Doctor extends Model
{
    protected $fillable = [
        'name','phone','address','specialization','dept_id'
    ];

    
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
    
}
