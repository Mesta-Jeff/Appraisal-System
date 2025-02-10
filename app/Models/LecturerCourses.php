<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LecturerCourses extends Model
{
    use HasFactory;
    protected $fillable = [
        'session_course_id',
        'lecturer_id',
        'description',
        'status'
    ];

    protected $hidden = [
        'updated_at',
        'is_deleted'
    ];
}
