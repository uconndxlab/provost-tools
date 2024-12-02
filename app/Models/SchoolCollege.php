<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolCollege extends Model
{
    use HasFactory;

    public function questionnaires()
    {
        return $this->hasMany(BudgetHearingQuestionnaire::class);
    }

    public function usersWithPermission($perm)
    {
        return $this->belongsToMany(User::class, 'school_user_permissions')
            ->withPivot($perm);
    }
}
