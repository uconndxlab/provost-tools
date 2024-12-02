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
        Schema::table('budget_hearing_questionnaires', function (Blueprint $table) {
            $table->foreignId('school_college_id')
            ->nullable() // Nullable if some questionnaires may not be tied to a school
            ->constrained()
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('budget_hearing_questionnaires', function (Blueprint $table) {
            
        });
    }
};
