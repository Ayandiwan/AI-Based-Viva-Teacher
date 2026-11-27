<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [

        'subject_id',

        'question',

        'answer',

        'difficulty',

    ];

    // Relationship with Subject
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // Relationship with Student Answers
    public function studentAnswers()
    {
        return $this->hasMany(StudentAnswer::class);
    }
}   