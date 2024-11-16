<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'patient_name','phone','dept_Id','bookDate','doctor_id'
    ];
}
