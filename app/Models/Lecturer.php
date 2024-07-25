<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lecturer extends Model
{
    use HasFactory;
    protected $fillable = [
        'staff_id',
        'title',
        'initials',
        'department_id',
        'first_name',
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
        'is_deleted'
    ];
}
