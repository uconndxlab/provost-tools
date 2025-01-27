<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitutionalPriority extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'weight', 'description'];

    public function projects()
    {
        return $this->belongsToMany(Project::class)->withPivot('score')->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
