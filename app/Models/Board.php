<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $table = 'board';

    protected $fillable = [
        'id',
        'user_id',
        'name_board',
    ];
}
