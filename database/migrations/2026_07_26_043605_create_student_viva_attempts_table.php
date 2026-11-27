<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('student_viva_attempts', function (Blueprint $table) {

        $table->id();

        $table->foreignId('student_id')
              ->constrained('users')
              ->cascadeOnDelete();

        $table->foreignId('subject_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->foreignId('question_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->text('student_answer')->nullable();

        $table->integer('marks')->nullable();

        $table->text('ai_feedback')->nullable();

        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_viva_attempts');
    }
};
