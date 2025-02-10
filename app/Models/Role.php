<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
        'description',
        'hook',
        'status',
    ];

    protected $hidden = [
        'is_deleted',
        'updated_at',
    ];
}
