<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_postings', function (Blueprint $table) {
            $table->date('deadline')->nullable()->after('salary');
            $table->text('requirements')->nullable()->after('description');
            $table->text('responsibilities')->nullable()->after('requirements');
        });
    }

    public function down(): void
    {
        Schema::table('job_postings', function (Blueprint $table) {
            $table->dropColumn(['deadline', 'requirements', 'responsibilities']);
        });
    }
};
