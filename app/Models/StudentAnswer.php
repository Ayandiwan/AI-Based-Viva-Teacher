<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Question;
use App\Models\Subject;
use App\Models\User;
use App\Models\StudentVivaResult;

class StudentAnswer extends Model
{
    protected $fillable = [
        'student_id',
        'subject_id',
        'question_id',
        'result_id',

        'answer_type',
        'answer',
        'voice_file',

        'marks',
        'feedback',
        'correct_answer',

        'ai_score',
        'ai_feedback',

        // GROQ AI
        'groq_score',
        'groq_feedback',

        

        // OPENROUTER AI
        'openrouter_score',
        'openrouter_feedback',

        // CLOUDFLARE AI
        'cloudflare_score',
        'cloudflare_feedback',
    ];

    // QUESTION
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // SUBJECT
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // STUDENT
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // VIVA RESULT
    public function result()
    {
        return $this->belongsTo(
            StudentVivaResult::class,
            'result_id'
        );
    }
}
