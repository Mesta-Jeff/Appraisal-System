<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'faculty',
        'description',
        'status',
    ];

    protected $hidden = [
        'is_deleted',
        'updated_at',
    ];
}
