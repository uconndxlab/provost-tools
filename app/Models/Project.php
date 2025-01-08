<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'budget', 'timeline', 'user_id'];

    public function institutionalPriorities()
    {
        return $this->belongsToMany(InstitutionalPriority::class)->withPivot('score')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
