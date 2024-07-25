<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = [
        'class',
        'description',
        'status',
    ];

    protected $hidden = [
        'is_deleted',
        'updated_at',
    ];
}
