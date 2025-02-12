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
        Schema::table('projects', function (Blueprint $table) {
            Schema::table('projects', function (Blueprint $table) {
                $table->foreignId('school_college_id')->nullable()->constrained('school_colleges')->onDelete('set null');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['school_college_id']);
            $table->dropColumn('school_college_id');
        });
    }
};
