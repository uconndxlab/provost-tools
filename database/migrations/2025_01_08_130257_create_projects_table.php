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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('budget', 15, 2); // Budget amount
            $table->date('start_date'); // Project start date
            $table->date('end_date'); // Project end date
            $table->string('status'); // Project status
            $table->text('description'); // Project description
            $table->decimal('current_spend', 15, 2); // Current spend
            $table->string('timeline'); // Timeline details
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Project owner
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
