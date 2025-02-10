<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SessionCourses extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'session_semester_id',
        'programme_id',
        'classes_id',
        'description',
        'status'
    ];

    protected $hidden = [
        'updated_at',
        'is_deleted'
    ];
}
