<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LDetails extends Model
{
    protected $fillable = [
        'raysCount',
'point',
'power',
'speed',
'pulse',
'device'
    ];

    public function Lazer():BelongsToMany
    {
        return $this->belongsToMany(Lazer::class,'lazer_details','lazer_id','l_details_id');
    }




}
