<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PatientDept extends Model
{
    protected $fillable = [
        'dept_id','patient_id','doctor_name',
    'illness','description','cure'
    ]; 

   

    public function Accounter():HasMany
    {
        return $this->hasMany(Accounter::class,'a_p_d_s')->withPivot('doctor_id','check_in_type','given_cure','tools','full_cost','status');
        
    }

}
