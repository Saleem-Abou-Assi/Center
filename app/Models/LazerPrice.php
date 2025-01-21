<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LazerPrice extends Model
{
    use HasFactory;
    
    protected $table = 'lazer_price';

    protected $fillable = [
        'ax_price',
        'ay_price',
        'again_price'
    ];

}
