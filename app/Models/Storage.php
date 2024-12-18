<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Storage extends Model
{
    protected $fillable = [
        'item','quantity'
    ];

    public function apds():BelongsToMany
    {
        return $this->belongsToMany(APD::class,'apd_storage','apd_id','storage_id')->withPivot('quantity');
    }

}
