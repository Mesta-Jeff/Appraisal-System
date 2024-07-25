<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Semester extends Model
{
    use HasFactory;
    protected $fillable = [
        'semester',
        'description',
        'status'
    ];

    protected $hidden = [
        'updated_at',
        'is_deleted'
    ];
}
