<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetHearingQuestionnaire extends Model
{
    use HasFactory;

    // $table->text('deficit_mitigation')->nullable();
    // $table->text('faculty_hiring')->nullable();
    // $table->text('student_enrollment')->nullable();
    // $table->text('student_retention')->nullable();
    // $table->text('foundation_engagement')->nullable();
    // $table->text('school_college')->nullable();

    protected $fillable = [
        'deficit_mitigation',
        'faculty_hiring',
        'student_enrollment',
        'student_retention',
        'foundation_engagement',
        'school_college',
        'library_research_activity',
        'library_student_enrollment',
    ];

    public function school()
    {
        return $this->belongsTo(SchoolCollege::class, 'school_college_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function history()
    {
        return $this->hasMany(BudgetHearingQuestionnaireHistory::class);
    }
    
}
