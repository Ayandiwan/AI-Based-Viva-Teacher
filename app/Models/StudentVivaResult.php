<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Subject;
use App\Models\StudentAnswer;

class StudentVivaResult extends Model
{
    protected $fillable = [
        'student_id',
        'subject_id',
        'attempt_no',
        'total_questions',
        'total_marks',
        'max_marks',
        'percentage',
        'overall_feedback',

        // GROQ AI TOTAL
        'groq_total',
        'groq_percentage',

        
        // OPENROUTER AI TOTAL
        'openrouter_total',
        'openrouter_percentage',

        // CLOUDFLARE AI TOTAL
        'cloudflare_total',
        'cloudflare_percentage',
    ];

    // STUDENT
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // SUBJECT
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // ALL ANSWERS OF THIS RESULT
    public function answers()
    {
        return $this->hasMany(
            StudentAnswer::class,
            'result_id'
        );
    }
}
