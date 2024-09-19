<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\JobHistory;
use App\Models\FileUpload;

class UploadPayrollNetidJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public FileUpload $fileupload)
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $job = JobHistory::create([
            'name' => 'UploadPayrollNetidJob',
            'status' => 'start',
            'message' => 'Processing payroll file ' . $this->fileupload->filename,
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

        $payroll_csv = array_map('str_getcsv', file(storage_path('app/' . $job->fileUpload->path)));

        if ( !$payroll_csv ) {
            $job->update([
                'status' => 'error',
                'message' => 'File could not be read.',
            ]);
            return;
        }

        if ( strtolower($payroll_csv[0][0]) !== 'payroll_id' || strtolower($payroll_csv[0][1]) !== 'netid' ) {
            $job->update([
                'status' => 'error',
                'message' => 'File format is incorrect.',
            ]);
            return;
        }

        $num_users = count($payroll_csv) - 1;
        $job->update([
            'message' => 'Processing ' . $num_users . ' users.',
        ]);
    
        foreach ($payroll_csv as $i => $row) {
            if ( $row[0] === 'payroll_id' || !$row[0] ) {
                continue;
            }
            User::upsert([
                'netid' => $row[1],
                'emplid' => $row[0],
                'name' => $row[1],
                'email' => $row[1] . '@uconn.edu',
            ], uniqueBy: ['netid'], update: ['emplid']);

            $job->update([
                'message' => 'Processed ' . $i + 1 . '/' . $num_users . ' users.',
            ]);
        }

        $job->update([
            'status' => 'complete',
            'message' => 'Processed ' . $num_users . ' users.',
        ]);
    }
}
