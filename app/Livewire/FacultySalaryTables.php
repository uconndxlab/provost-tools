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

    public $sort = 'full_name';
    public $sortDirection = 'asc';

    public function updated($property)
    {
        // $property: The name of the current property that was updated
        if ($property !== 'page') {
            $this->resetPage();
        }
    }

    public function sortBy($field)
    {
        if ($this->sort === $field) {
            if ( $this->sortDirection === 'desc' ) {
                $this->sort = 'full_name';
                $this->sortDirection = 'asc';
            } else {
                $this->sortDirection = 'desc';
            }
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sort = $field;
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

        $netid = Auth::user()->netid;
        $school_college_admin_list = [
            'Agriculture,Health,Natural Rc' => ['alr03008', 'amh22027', 'keg95003', 'inc18002', 'ksv02002'],
            'Business' => ['mil02007', 'grr07002', 'nom02003', 'cml05005', 'jmc04008', 'dab13012'],
            'Education' => ['jai05001', 'bas08012', 'eam14013', 'doa13001', 'nsb02004'],
            'Engineering' => ['dbh24003', 'kea04003', 'geb09004', 'ddb10003', 'dmt02003'],
            'Fine Arts' => ['alf02016', 'ckb01001', 'jan24002'],
            'Global Affairs' => [],
            'Law' => ['cnm22002', 'esn20002', 'jun16105', 'acd02004', 'mkl13001', 'jer02009'],
            'Liberal Arts and Sciences' => ['kal04009', 'mir04001', 'meg13017', 'ofh05001', 'ebt18003', 'bow02001', 'bap02005'],
            'Nursing' => ['clc02011', 'vsv23001', 'ank04010', 'anm06014', 'nsr21001', 'jrs06005'],
            'OVPR' => ['jds05004'],
            'Pharmacy' => ['pmh03001', 'scm13009', 'nmr16101', 'kaw07013'],
            'Provost Academic Affairs' => [],
            'Social Work' => ['lac23013', 'stm96003', 'jim22010', 'sch04003',],
        ];
        $schools_for_this_user = array_keys(array_filter($school_college_admin_list, function($admins) use ($netid) {
            return in_array($netid, $admins);
        }));


        $department_special_access_list = [
            'Werth Institute' => ['dan12005'],
            'Materials Science Institute' => ['sls02012'],
            'System Genomics Institute' => ['rjo02003'],
            'CT Ntl Estuarine Research Rsrv' => ['crt09001'],
            'Sea Grant' => ['syd02001'],
            'InCHIP' => ['tml14004', 'jrs06005'],
        ];

        /**
         * This is where a user is limited to see what is in their department or school.
         */
        if ( !Auth::user()->can_admin && empty($schools_for_this_user) ) {
            $fst = Auth::user()->facultySalaryTables->first();
            $allowed_dept = $fst->academic_department ?? null;
            $allowed_school = $fst->academic_school_college ?? null;
            $faculty_salary_tables->where('academic_department', $allowed_dept)
                ->where('academic_school_college', $allowed_school);
        }

        if (!empty($schools_for_this_user && !Auth::user()->can_admin)) {
            
            $faculty_salary_tables->whereIn('academic_school_college', $schools_for_this_user);

            $schools = $schools->filter(function($school) use ($schools_for_this_user) {
                return in_array($school, $schools_for_this_user);
            });
    
        }

        if ( !empty($department_special_access_list) && !Auth::user()->can_admin ) {
            $faculty_salary_tables->orWhere(function($query) use ($department_special_access_list) {
                foreach ($department_special_access_list as $department => $admins) {
                    if (in_array(Auth::user()->netid, $admins)) {
                        $query->orWhere('academic_department', $department);
                    }
                }
            });
        }

 

        $departments = $departments->distinct()
            ->orderBy('academic_department')
            ->get()
            ->pluck('academic_department');

            $faculty_salary_tables = $faculty_salary_tables
            ->orderBy('academic_school_college') // Always sort by this first
            ->orderBy($this->sort, $this->sortDirection) // Then sort by the selected field and direction
            ->paginate(100);
        
        return view('livewire.faculty-salary-tables', compact('faculty_salary_tables', 'schools', 'departments'));
    }
}
