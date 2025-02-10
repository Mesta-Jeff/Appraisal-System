<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Programme extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'programme',
        'duration',
        'description',
        'status',
    ];

    protected $hidden = [
        'is_deleted',
        'updated_at',
    ];
}
