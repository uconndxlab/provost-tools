<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'budget', 'timeline', 'user_id', 'description', 'start_date', 'end_date', 'status', 'current_spend', 'complexity', 'school_college_id'];

    public function institutionalPriorities()
    {
        return $this->belongsToMany(InstitutionalPriority::class)->withPivot('score')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getScoreByPriority($priorityId)
    {
        $priority = $this->institutionalPriorities->find($priorityId);
        return $priority ? $priority->pivot->score : null;
    }

    // get the scores for the project, grouped by priority's tag
    // public function getScoresByTag($tagId)
    // {
    //     $filteredPriorities = $this->institutionalPriorities->filter(function ($priority) use ($tagId) {
    //         return $priority->tags->contains('id', $tagId);
    //     });

    //     $totalScore = $filteredPriorities->sum(function ($priority) {
    //         return $priority->pivot->score * $priority->weight;
    //     });

    //     $maxScore = $filteredPriorities->max(function ($priority) {
    //         return $priority->pivot->score * $priority->weight;
    //     });

    //     $averageScore = round($filteredPriorities->avg(function ($priority) {
    //         return $priority->pivot->score * $priority->weight;
    //     }), 2);


    //     // possiblemaxscore is the total sum of the weights assigned to the priorities
    //     $possibleMaxScore = $filteredPriorities->sum(function ($priority) {
    //         return $priority->weight * 5; // assuming the max rating is 5
    //     });

    //     return [
    //         'total_score' => $totalScore,
    //         'max_score' => $maxScore,
    //         'average_score' => $averageScore,
    //         'possible_max_score' => $possibleMaxScore
    //     ];
    // }

    public function getPrioritiesByTag($tagId)
    {
        return $this->institutionalPriorities->filter(function ($priority) use ($tagId) {
            return $priority->tags->contains('id', $tagId);
        });
    }

    public function schoolCollege()
    {
        return $this->belongsTo(SchoolCollege::class);
    }
}
