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
        Schema::create('faculty_salary_tables', function (Blueprint $table) {
            $table->id();
            $table->text('academic_school_college');
            $table->text('academic_department');
            $table->string('emplid')->unique();
            $table->text('full_name');
            $table->text('tt_ntt');
            $table->text('rank_description');
            $table->text('faculty_role');
            $table->text('affiliated_department_name_administrative_roles');
            $table->text('union_name');
            $table->text('empl_class_description');
            $table->text('payroll_fte');
            $table->text('faculty_base_appointment_term');
            $table->integer('appointment_term');
            $table->integer('faculty_base_ucannl');
            $table->integer('additional_1_month_uc1mth');
            $table->integer('additional_2_month_uc2mth');
            $table->integer('admin_supplement_ucadm');
            $table->integer('full_time_annual_salary');
            $table->integer('nine_mo_equivalent_of_annual_salary');
            $table->integer('nine_mo_equivalent_of_base_salary');
            $table->text('gender');
            $table->integer('years_of_service');
            $table->text('assistant_professor_year');
            $table->text('associate_professor_year');
            $table->text('professor_year');
            $table->integer('years_in_rank');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_ids');
        Schema::dropIfExists('faculty_salary_tables');
    }
};
