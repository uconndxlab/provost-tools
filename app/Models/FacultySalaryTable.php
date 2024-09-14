<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FacultySalaryTable extends Model
{
    protected $guarded = [];
    protected $table = 'faculty_salary_tables';

    public function user() {
        return $this->belongsTo(User::class, 'emplid', 'emplid');
    }
}
