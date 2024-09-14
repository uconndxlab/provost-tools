<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Models\FacultySalaryTable;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FacultySalaryTables extends Component
{
    use WithPagination;

    #[Url(except: '')]
    public $search;

    #[Url(except: '')]
    public $school;

    #[Url(except: '')]
    public $department;

    public function updated($property)
    {
        // $property: The name of the current property that was updated
        if ($property !== 'page') {
            $this->resetPage();
        }
    }

    public function render()
    {
        $schools = FacultySalaryTable::select('academic_school_college')
            ->distinct()
            ->orderBy('academic_school_college')
            ->get()
            ->pluck('academic_school_college');
        $departments = FacultySalaryTable::select('academic_department');
        $faculty_salary_tables = FacultySalaryTable::with(['user']);

        if ( $this->school ) {
            $departments->where('academic_school_college', $this->school);
            $faculty_salary_tables->where('academic_school_college', $this->school);
        }

        if ( $this->department ) {
            $faculty_salary_tables->where('academic_department', $this->department);
        }

        if ( request()->sort ) {
            $faculty_salary_tables->orderBy(request()->sort);
        }

        if ( $this->search ) {
            $faculty_salary_tables->where(function($query) {
                $query->where('full_name', 'like', '%' . $this->search . '%')
                    ->orWhere('academic_school_college', 'like', '%' . $this->search . '%')
                    ->orWhere('academic_department', 'like', '%' . $this->search . '%');
            });
        }

        /**
         * This is where a user is limited to see what is in their department or school.
         */
        if ( !Auth::user()->can_admin ) {
            $fst = Auth::user()->facultySalaryTables->first();
            $allowed_dept = $fst->academic_department ?? null;
            $allowed_school = $fst->academic_school_college ?? null;
            $faculty_salary_tables->where(function($query) use ($allowed_dept, $allowed_school) {
                $query->where('academic_department', $allowed_dept)
                    ->orWhere('academic_school_college', $allowed_school);
            });
        }

        $departments = $departments->distinct()
            ->orderBy('academic_department')
            ->get()
            ->pluck('academic_department');

        $faculty_salary_tables = $faculty_salary_tables->orderBy('academic_school_college')
            ->orderBy('academic_department')
            ->orderBy('full_name')
            ->paginate(100);
        return view('livewire.faculty-salary-tables', compact('faculty_salary_tables', 'schools', 'departments'));
    }
}
