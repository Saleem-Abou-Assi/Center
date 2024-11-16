<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Field extends Model
{
    protected $fillable = 
    [
        'name','value'
    ];
    
    public function Patient():BelongsToMany
    {
        return $this->belongsToMany(Field::class,'patient_fields','patient_id','field_id');
    }
}
