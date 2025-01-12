<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApdStorage extends Model
{
    protected $fillable = [
        'APD_id','storage_id','quantity'
    ];

    public function storage():BelongsTo
    {
        return $this->belongsTo(Storage::class);
    }

    public function doctor():BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
}
