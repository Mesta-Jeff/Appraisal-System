<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'faculty_id',
        'department',
        'description',
        'status',
    ];

    protected $hidden = [
        'is_deleted',
        'updated_at',
    ];
}
