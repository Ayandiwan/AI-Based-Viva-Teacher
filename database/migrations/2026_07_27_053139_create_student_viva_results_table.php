<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_viva_results', function (Blueprint $table) {

           Schema::create('student_viva_results', function (Blueprint $table) {

    $table->id();

    $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();

    $table->foreignId('subject_id')->constrained()->cascadeOnDelete();

    $table->integer('attempt_no');

    $table->integer('total_questions');

    $table->integer('total_marks');

    $table->integer('max_marks');

    $table->decimal('percentage', 5, 2);

    $table->text('overall_feedback')->nullable();

    $table->timestamps();
});
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_viva_results');
    }
};