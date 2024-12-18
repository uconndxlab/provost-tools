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
        Schema::create('budget_hearing_questionnaires', function (Blueprint $table) {
            $table->id();
            $table->text('deficit_mitigation')->nullable();
            $table->text('faculty_hiring')->nullable();
            $table->text('student_enrollment')->nullable();
            $table->text('student_retention')->nullable();
            $table->text('foundation_engagement')->nullable();
            $table->text('library_research_activity')->nullable();
            $table->text('library_student_enrollment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_hearing_questionnaires');
    }
};
