<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('profiles', 'job_title')) {
                $table->string('job_title')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('profiles', 'location')) {
                $table->string('location')->nullable()->after('job_title');
            }
        });

        Schema::table('job_postings', function (Blueprint $table) {
            if (!Schema::hasColumn('job_postings', 'category')) {
                $table->string('category')->nullable()->after('type');
            }
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            if (Schema::hasColumn('profiles', 'job_title')) {
                $table->dropColumn('job_title');
            }
            if (Schema::hasColumn('profiles', 'location')) {
                $table->dropColumn('location');
            }
        });

        Schema::table('job_postings', function (Blueprint $table) {
            if (Schema::hasColumn('job_postings', 'category')) {
                $table->dropColumn('category');
            }
        });
    }
};
