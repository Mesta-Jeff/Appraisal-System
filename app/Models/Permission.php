<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'permission',
        'permission_key',
        'description',
        'hook',
        'status',
    ];

    protected $hidden = [
        'is_deleted',
        'updated_at',
    ];
}
