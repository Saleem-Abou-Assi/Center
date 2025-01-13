<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
class Setting extends Model
{
public $timestamps = false;
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (is_null($model->installation_date)) {
                $model->installation_date = Carbon::now()->addMinutes(2); 
            }
        });
    }
}
