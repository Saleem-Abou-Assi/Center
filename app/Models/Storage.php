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
        return $this->belongsToMany(APD::class,'apd_storage','storage_id','apd_id')->withPivot('quantity');
    }
}
