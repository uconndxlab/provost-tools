<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\JobHistory;
use App\Models\FileUpload;
use App\Models\FacultySalaryTable;

class UploadFacultySalaryTablesJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public FileUpload $fileupload, public bool $remove = false)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $job = JobHistory::create([
            'name' => 'UploadFacultySalaryTablesJob',
            'status' => 'start',
            'message' => 'Processing salary tables file ' . $this->fileupload->filename,
            'user_id' => $this->fileupload->user_id,
            'file_upload_id' => $this->fileupload->id,
        ]);

        if ( !$job->fileUpload->path ) {
            $job->update([
                'status' => 'error',
                'message' => 'File path not found.',
            ]);
            return;
        }

        $salary_csv = array_map('str_getcsv', file(storage_path('app/' . $job->fileUpload->path)));

        if ( !$salary_csv ) {
            $job->update([
                'status' => 'error',
                'message' => 'File could not be read.',
            ]);
            return;
        }

        if ( count($salary_csv[0]) !== 26 ) {
            $job->update([
                'status' => 'error',
                'message' => 'File format is incorrect.',
            ]);
            return;
        }


        if ( $this->remove ) {
            FacultySalaryTable::truncate();
        }
        
        $num_tabs = count($salary_csv) - 1;
        $job->update([
            'message' => 'Processing ' . $num_tabs . ' entries.',
        ]);

        foreach ($salary_csv as $i => $row) {
            if ( $row[0] === 'academic_school_college' || !$row[0] ) {
                continue;
            }
            FacultySalaryTable::upsert([
                'academic_school_college' => $row[0],
                'academic_department' => $row[1],
                'emplid' => $row[2],
                'full_name' => $row[3],
                'tt_ntt' => $row[4],
                'rank_description' => $row[5],
                'faculty_role' => $row[6],
                'affiliated_department_name_administrative_roles' => $row[7],
                'union_name' => $row[8],
                'empl_class_description' => $row[9],
                'payroll_fte' => $row[10],
                'faculty_base_appointment_term' => $row[11],
                'appointment_term' => $row[12],
                'faculty_base_ucannl' => $row[13],
                'additional_1_month_uc1mth' => $row[14],
                'additional_2_month_uc2mth' => $row[15],
                'admin_supplement_ucadm' => $row[16],
                'full_time_annual_salary' => $row[17],
                'nine_mo_equivalent_of_annual_salary' => $row[18],
                'nine_mo_equivalent_of_base_salary' => $row[19],
                'gender' => $row[20],
                'years_of_service' => $row[21],
                'assistant_professor_year' => $row[22],
                'associate_professor_year' => $row[23],
                'professor_year' => $row[24],
                'years_in_rank' => $row[25]
            ], uniqueBy: ['emplid'], update: [
                'academic_school_college',
                'academic_department',
                'full_name',
                'tt_ntt',
                'rank_description',
                'faculty_role',
                'affiliated_department_name_administrative_roles',
                'union_name',
                'empl_class_description',
                'payroll_fte',
                'faculty_base_appointment_term',
                'appointment_term',
                'faculty_base_ucannl',
                'additional_1_month_uc1mth',
                'additional_2_month_uc2mth',
                'admin_supplement_ucadm',
                'full_time_annual_salary',
                'nine_mo_equivalent_of_annual_salary',
                'nine_mo_equivalent_of_base_salary',
                'gender',
                'years_of_service',
                'assistant_professor_year',
                'associate_professor_year',
                'professor_year',
                'years_in_rank'
            ]);

            $u = User::where('emplid', $row[2])->first();

            if ( $u ) {
                if ( $u->netid === $u->name ) {
                    $u->update([
                        'department' => $row[1],
                        'name' => $row[3],
                    ]);
                }
            }

            $job->update([
                'message' => 'Processed ' . $i + 1 . '/' . $num_tabs . ' entries.',
            ]);
        }

        $job->update([
            'status' => 'complete',
            'message' => 'Processed ' . $num_tabs . ' entries.',
        ]);
    }
}
