<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PatientDept extends Model
{
    protected $fillable = [
        'dept_id','patient_id','doctor_name',
    'illness','description','cure'
    ]; 

    

    public function Accounter():BelongsToMany
    {
        return $this->belongsToMany(Accounter::class,'a_p_d_s','PD_id','A_id')->withPivot('doctor_id','check_in_type','given_cure','full_cost','status');
    }

    public function Department():BelongsTo
    {
        return $this->belongsTo(Department::class,'dept_id');
    }

}
