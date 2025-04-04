<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'netid',
        'emplid',
        'affiliation',
        'title',
        'department'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function facultySalaryTables() {
        return $this->hasMany(FacultySalaryTable::class, 'emplid', 'emplid');
    }

    public function schoolColleges() {
        return $this->belongsToMany(SchoolCollege::class, 'school_user_permissions')->withPivot('can_submit_budget_hearing_questionnaire');
    }

    public function schoolsWithPermission($perm) {
        return $this->schoolColleges()->wherePivot($perm, true);
    }
}
