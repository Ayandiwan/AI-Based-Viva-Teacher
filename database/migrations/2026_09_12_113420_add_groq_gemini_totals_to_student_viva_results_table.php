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
        Schema::table('student_viva_results', function (Blueprint $table) {

            // =========================
            // GROQ TOTAL
            // =========================

            if (!Schema::hasColumn('student_viva_results', 'groq_total')) {

                $table->integer('groq_total')
                    ->default(0)
                    ->after('total_marks');

            }


            // =========================
            // GEMINI TOTAL
            // =========================

            if (!Schema::hasColumn('student_viva_results', 'gemini_total')) {

                $table->integer('gemini_total')
                    ->default(0)
                    ->after('groq_total');

            }


            // =========================
            // OPENROUTER TOTAL
            // =========================

            if (!Schema::hasColumn('student_viva_results', 'openrouter_total')) {

                $table->decimal('openrouter_total', 8, 2)
                    ->default(0)
                    ->after('gemini_total');

            }


            // =========================
            // GROQ PERCENTAGE
            // =========================

            if (!Schema::hasColumn('student_viva_results', 'groq_percentage')) {

                $table->decimal('groq_percentage', 5, 2)
                    ->default(0)
                    ->after('percentage');

            }


            // =========================
            // GEMINI PERCENTAGE
            // =========================

            if (!Schema::hasColumn('student_viva_results', 'gemini_percentage')) {

                $table->decimal('gemini_percentage', 5, 2)
                    ->default(0)
                    ->after('groq_percentage');

            }


            // =========================
            // OPENROUTER PERCENTAGE
            // =========================

            if (!Schema::hasColumn('student_viva_results', 'openrouter_percentage')) {

                $table->decimal('openrouter_percentage', 5, 2)
                    ->default(0)
                    ->after('gemini_percentage');

            }

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_viva_results', function (Blueprint $table) {

            if (Schema::hasColumn('student_viva_results', 'openrouter_percentage')) {
                $table->dropColumn('openrouter_percentage');
            }

            if (Schema::hasColumn('student_viva_results', 'gemini_percentage')) {
                $table->dropColumn('gemini_percentage');
            }

            if (Schema::hasColumn('student_viva_results', 'groq_percentage')) {
                $table->dropColumn('groq_percentage');
            }

            if (Schema::hasColumn('student_viva_results', 'openrouter_total')) {
                $table->dropColumn('openrouter_total');
            }

            if (Schema::hasColumn('student_viva_results', 'gemini_total')) {
                $table->dropColumn('gemini_total');
            }

            if (Schema::hasColumn('student_viva_results', 'groq_total')) {
                $table->dropColumn('groq_total');
            }

        });
    }
};
