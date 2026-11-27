<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('student_answers', function (Blueprint $table) {

            // =========================
            // HUGGING FACE AI
            // =========================

            $table->decimal('huggingface_score', 5, 2)
                ->nullable()
                ->after('groq_feedback');

            $table->text('huggingface_feedback')
                ->nullable()
                ->after('huggingface_score');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_answers', function (Blueprint $table) {

            $table->dropColumn([
                'huggingface_score',
                'huggingface_feedback',
            ]);

        });
    }
};