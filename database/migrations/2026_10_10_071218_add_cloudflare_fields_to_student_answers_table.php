<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_answers', function (Blueprint $table) {
            $table->decimal('cloudflare_score', 4, 2)->nullable();
            $table->text('cloudflare_feedback')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('student_answers', function (Blueprint $table) {
            $table->dropColumn([
                'cloudflare_score',
                'cloudflare_feedback',
            ]);
        });
    }
};