<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FacultySalaryTable;
use App\Models\PayrollId;

class FacultySalaryTablesController extends Controller
{
    public function index(Request $request) {
        // Go to app/Livewire/FacultySalaryTables
        return view('faculty_salary_tables.index');
    }

    public function adminIndex(Request $request) {
        return view('faculty_salary_tables.admin_index');
    }
}
