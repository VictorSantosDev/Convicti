<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $fillable = [
        'id',
        'user_id',
        'point_of_sale_id',
        'near_point_of_sale_id',
        'sale_values',
        'date',
        'hour',
        'km_near_point_of_sale',
        'latitude',
        'longitude',
        'is_roaming',
    ];
}
