<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'budget', 'timeline', 'user_id', 'description', 'start_date', 'end_date', 'status', 'current_spend'];

    public function institutionalPriorities()
    {
        return $this->belongsToMany(InstitutionalPriority::class)->withPivot('score')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // get the scores for the project, grouped by priority's tag
    public function getScoresByTag($tagId)
    {
        $filteredPriorities = $this->institutionalPriorities->filter(function ($priority) use ($tagId) {
            return $priority->tags->contains('id', $tagId);
        });

        $totalScore = $filteredPriorities->sum('pivot.score');
        $maxScore = $filteredPriorities->max('pivot.score');
        $averageScore = $filteredPriorities->avg('pivot.score');
        // possiblemaxscore is the total sum of the weights assigned to the priorities
        $possibleMaxScore = $filteredPriorities->sum('weight');

        return [
            'total_score' => $totalScore,
            'max_score' => $maxScore,
            'average_score' => $averageScore,
            'possible_max_score' => $possibleMaxScore
        ];
    }
}
