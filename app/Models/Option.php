<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Option extends Model
{
    use HasFactory;

    protected $fillable = ['option_text'];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_options');
    }

    protected $hidden = [
        'updated_at',
        'is_deleted'
    ];
}
