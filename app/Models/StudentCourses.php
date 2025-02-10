<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentCourses extends Model
{
    use HasFactory;
    protected $fillable = [
        'session_course_id',
        'student_id',
        'description',
        'status'
    ];

    protected $hidden = [
        'updated_at',
        'is_deleted'
    ];
}
