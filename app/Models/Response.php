<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Response extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'session_course_id', 'lecturer_id', 'question_id', 'question_option_id', 'comment'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function sessionCourse()
    {
        return $this->belongsTo(SessionCourses::class);
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function questionOption()
    {
        return $this->belongsTo(QuestionOption::class);
    }

    protected $hidden = [
        'updated_at',
        'is_deleted'
    ];
}
