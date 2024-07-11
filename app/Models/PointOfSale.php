<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointOfSale extends Model
{
    use HasFactory;

    protected $table = 'point_of_sale';

    protected $fillable = [
        'id',
        'board_id',
        'name',
        'latitude',
        'longitude',
    ];
}
