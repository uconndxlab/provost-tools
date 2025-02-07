<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimationShowcaseSubmission extends Model
{
    use HasFactory;
    protected $fillable = [
        'submittor_name',
        'submittor_email',
        'institution',
        'program',
        'program_description',
        'program_link',
        'student_names',
        'student_bios',
        'title',
        'video_link',
        'synopsis',
        'description',
        'accessibility_compliant'
    ];
    
}
