<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolCollege extends Model
{
    use HasFactory;

    public function questionnaire()
    {
        return $this->hasOne(BudgetHearingQuestionnaire::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'school_user_permissions')->withPivot('can_submit_budget_hearing_questionnaire');
    }

    public function usersWithPermission($perm)
    {
        return $this->users()->wherePivot($perm, true);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
