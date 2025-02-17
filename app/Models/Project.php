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

    public function getWeightedScoreByPriority($priorityId)
    {
        $priority = $this->institutionalPriorities->find($priorityId);
    
        if ($priority) {
            $rawScore = $priority->pivot->score; // Score is 1-5
            $normalizedScore = ($rawScore - 1) / 4; // Convert to 0-1 scale
    
            return $normalizedScore * $priority->weight * 100; // Scale by weight
        }
    
        return 0;
    }
    

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
