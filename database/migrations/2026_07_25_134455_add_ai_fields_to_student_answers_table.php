<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    Schema::table('student_answers', function (Blueprint $table) {

        $table->text('correct_answer')->nullable();

        $table->text('ai_feedback')->nullable();

        $table->integer('ai_score')
              ->nullable();

    });
}


public function down(): void
{
    Schema::table('student_answers', function (Blueprint $table) {

        $table->dropColumn([
            'correct_answer',
            'ai_feedback',
            'ai_score'
        ]);

    });
}

};
