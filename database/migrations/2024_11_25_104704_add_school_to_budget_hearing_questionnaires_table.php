<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('budget_hearing_questionnaires', function (Blueprint $table) {
            $table->string('school_college')->nullable(); 
        });
    }
    
    public function down()
    {
        Schema::table('budget_hearing_questionnaires', function (Blueprint $table) {
            $table->dropColumn('school_college');
        });
    }
};
