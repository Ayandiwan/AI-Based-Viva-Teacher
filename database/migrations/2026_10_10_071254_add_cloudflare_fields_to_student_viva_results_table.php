<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_viva_results', function (Blueprint $table) {
            $table->decimal('cloudflare_total', 8, 2)->nullable();
            $table->decimal('cloudflare_percentage', 5, 2)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('student_viva_results', function (Blueprint $table) {
            $table->dropColumn([
                'cloudflare_total',
                'cloudflare_percentage',
            ]);
        });
    }
};