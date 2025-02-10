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
        Schema::table('animation_showcase_submissions', function (Blueprint $table) {
            $table->string('program_link')->nullable()->after('program_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('animation_showcase_submissions', function (Blueprint $table) {
            $table->dropColumn('program_link');
        });
    }
};
