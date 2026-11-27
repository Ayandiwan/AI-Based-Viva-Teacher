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
            // HUGGING FACE AI TOTAL
            // =========================

            $table->decimal('huggingface_total', 8, 2)
                ->nullable()
                ->after('groq_percentage');

            $table->decimal('huggingface_percentage', 5, 2)
                ->nullable()
                ->after('huggingface_total');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_viva_results', function (Blueprint $table) {

            $table->dropColumn([
                'huggingface_total',
                'huggingface_percentage',
            ]);

        });
    }
};