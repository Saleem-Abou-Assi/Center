<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'patient_name','phone','dept_Id','bookDate','doctor_id','notes'
    ];

    // relation with doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    
    
}
