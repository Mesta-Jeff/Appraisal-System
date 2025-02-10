<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['section_id', 'question_text', 'question_for'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function options()
    {
        return $this->belongsToMany(Option::class, 'question_options');
    }

    protected $hidden = [
        'updated_at',
        'is_deleted'
    ];
}
