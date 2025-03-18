<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\FacultySalaryTable;
use App\Models\User;

/**
 * This file requires that a CSV file named payroll_ids.csv be present in the database/seeders directory.
 * The CSV file should have two columns: netid and payroll_id.
 * 
 * This file requires that a CSV file named faculty_salaries_fy_2025.csv be present in the database/seeders directory.
 */


class FacultySalarySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $payroll_csv = array_map('str_getcsv', file('database/seeders/export.csv'));
        $faculty_csv = array_map('str_getcsv', file('database/seeders/FacultySalaryTables_V2.csv'));

        foreach ($payroll_csv as $row) {
            if ( $row[0] === 'payroll_id' || !$row[0] ) {
                continue;
            }
            User::upsert([
                'netid' => $row[1],
                'emplid' => $row[0],
                'name' => $row[1],
                'email' => $row[1] . '@uconn.edu',
            ], uniqueBy: ['netid'], update: ['emplid']);
        }

        FacultySalaryTable::truncate();

        foreach ($faculty_csv as $row) {
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
        }
    }
}
