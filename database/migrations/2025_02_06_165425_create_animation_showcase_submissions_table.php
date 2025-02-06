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
        Schema::create('animation_showcase_submissions', function (Blueprint $table) {
            $table->id();
            $table->string("submittor_name");
            $table->string("submittor_email");

            $table->string('institution');
            $table->string('program');
            $table->text('program_description')->nullable();
            $table->text('student_names');
            $table->text('student_bios');
            $table->string('title');
            $table->string('video_link');
            $table->text('synopsis');
            $table->text('description');
            $table->boolean('accessibility_compliant')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animation_showcase_submissions');
    }
};
