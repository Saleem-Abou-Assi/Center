<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class APD extends Model
{
    protected $fillable = [
        'PD_id','A_id','doctor_id','patient_name','check_in_type','given_cure','full_cost','status'
    ];


    public function storage():BelongsToMany
    {
        return $this->belongsToMany(Storage::class,'apd_storage','apd_id','storage_id')->withPivot('quantity');
    }
    // public function PatientDept()
    // {

    // } 
    

}
