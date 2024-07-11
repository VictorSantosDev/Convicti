<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuleHasPermission extends Model
{
    use HasFactory;

    protected $table = 'rule_has_permission';

    protected $fillable = [
        'id',
        'rule_id',
        'permission_id',
        'created_at',
        'updated_at',
    ];
}
