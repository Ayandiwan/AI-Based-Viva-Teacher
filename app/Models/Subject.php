<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Question;

class Subject extends Model
{
    protected $fillable = [
        'teacher_id',
        'subject_name',
        'subject_code',
        'description',
    ];

    // Teacher who created the subject
    public function teacher()
    {
        return $this->belongsTo(
            User::class,
            'teacher_id'
        );
    }

    // Questions belonging to this subject
    public function questions()
    {
        return $this->hasMany(
            Question::class,
            'subject_id'
        );
    }
}