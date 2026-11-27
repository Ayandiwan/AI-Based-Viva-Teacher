<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentVivaAttempt extends Model
{
    protected $fillable = [
        'student_id',
        'subject_id',
        'question_id',
        'student_answer',
        'marks',
        'ai_feedback',
    ];
}