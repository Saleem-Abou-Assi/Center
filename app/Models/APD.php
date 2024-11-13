<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class APD extends Model
{
    protected $fillable = [
        'PD_id','A_id','doctor_id','check_in_type','given_cure','tools','full_cost','status'
    ];


    
}
