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
            $table->dropColumn('school_college');
            $table->foreignId('school_college_id')->nullable(false)->onDelete('cascade')->change();
        });

        Schema::create('budget_hearing_questionnaire_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('budget_hearing_questionnaire_id')->constrained()->onDelete('cascade');
            $table->text('deficit_mitigation')->nullable();
            $table->text('faculty_hiring')->nullable();
            $table->text('student_enrollment')->nullable();
            $table->text('student_retention')->nullable();
            $table->text('foundation_engagement')->nullable();
            $table->text('library_research_activity')->nullable();
            $table->text('library_student_enrollment')->nullable();
            $table->foreignId('user_id')->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_hearing_questionnaire_history');
        Schema::table('budget_hearing_questionnaires', function (Blueprint $table) {
            $table->foreignId('school_college_id')->nullable()->constrained()->change();
            $table->text('school_college')->nullable();
        });
    }
};
