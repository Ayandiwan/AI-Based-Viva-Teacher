
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

            $table->integer('groq_total')
                ->default(0)
                ->after('total_marks');

            $table->integer('gemini_total')
                ->default(0)
                ->after('groq_total');

            $table->decimal('groq_percentage', 5, 2)
                ->default(0)
                ->after('percentage');

            $table->decimal('gemini_percentage', 5, 2)
                ->default(0)
                ->after('groq_percentage');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_viva_results', function (Blueprint $table) {

            $table->dropColumn([
                'groq_total',
                'gemini_total',
                'groq_percentage',
                'gemini_percentage',
            ]);

        });
    }
};
