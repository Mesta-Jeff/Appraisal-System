<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_number',
        'initials',
        'programme_id',
        'class_id',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'dob',
        'phone',
        'email',
        'profile',
        'status'
    ];

    protected $hidden = [
        'updated_at',
        'is_deleted',
        'is_completed',
        'year_completed'
    ];
}
