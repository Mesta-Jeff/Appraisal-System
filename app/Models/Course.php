<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'programme_id',
        'course',
        'course_code',
        'course_type',
        'accessors',
        'description',
        'status',
    ];

    protected $hidden = [
        'is_deleted',
        'updated_at',
    ];
}
