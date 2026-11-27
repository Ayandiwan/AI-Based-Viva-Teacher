<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_answers', function (Blueprint $table) {

            $table->foreignId('result_id')
                ->nullable()
                ->after('question_id')
                ->constrained('student_viva_results')
                ->cascadeOnDelete();

        });
    }


    public function down(): void
    {
        Schema::table('student_answers', function (Blueprint $table) {

            $table->dropForeign(['result_id']);

            $table->dropColumn('result_id');

        });
    }
};