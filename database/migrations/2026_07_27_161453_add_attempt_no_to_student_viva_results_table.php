<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_viva_results', function (Blueprint $table) {
            $table->integer('attempt_no')->default(1)->after('subject_id');
            $table->text('overall_feedback')->nullable()->after('percentage');
        });
    }

    public function down(): void
    {
        Schema::table('student_viva_results', function (Blueprint $table) {
            $table->dropColumn(['attempt_no', 'overall_feedback']);
        });
    }
};