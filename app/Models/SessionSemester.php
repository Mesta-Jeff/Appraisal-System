<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SessionSemester extends Model
{
    use HasFactory;
    protected $fillable = [
        'session_id',
        'semester_id',
        'begins',
        'ends',
        'description',
        'status'
    ];

    protected $hidden = [
        'updated_at',
        'is_deleted'
    ];
}
