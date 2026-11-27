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
            // OPENROUTER TOTAL
            // =========================

            $table->decimal(
                'openrouter_total',
                8,
                2
            )
            ->default(0)
            ->after('gemini_total');


            // =========================
            // OPENROUTER PERCENTAGE
            // =========================

            $table->decimal(
                'openrouter_percentage',
                5,
                2
            )
            ->default(0)
            ->after('gemini_percentage');

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_viva_results', function (Blueprint $table) {

            $table->dropColumn([

                'openrouter_total',

                'openrouter_percentage',

            ]);

        });
    }
};
