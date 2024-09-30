<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'section'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    protected $hidden = [
        'updated_at',
        'is_deleted'
    ];
}
