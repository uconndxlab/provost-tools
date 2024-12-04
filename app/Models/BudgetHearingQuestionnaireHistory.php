<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetHearingQuestionnaireHistory extends Model
{
    protected $table = 'budget_hearing_questionnaire_history';
    protected $guarded = [];

    public function questionnaire()
    {
        return $this->belongsTo(BudgetHearingQuestionnaire::class, 'budget_hearing_questionnaire_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
