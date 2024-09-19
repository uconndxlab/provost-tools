<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Jobs\UploadPayrollNetidJob;
use App\Models\FileUpload;
use App\Models\JobHistory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class UploadPayrollNetid extends Component
{
    use WithFileUploads;
    
    public $job_status_text = '';
    public $progress = 0;
    public $file_upload_id = null;
    public $job_error = false;

    #[Validate('mimes:csv')]
    public $uploading_file;

    public function submitted() {

        $this->validate();
        $this->job_status_text = 'Syncing users...';
        $this->progress = 33;
        $p = $this->uploading_file->store(path: 'payroll');
        $file_upload = FileUpload::create([
            'filename' => $this->uploading_file->getClientOriginalName(),
            'path' => $p,
            'mime_type' => $this->uploading_file->getMimeType(),
            'size' => $this->uploading_file->getSize(),
            'user_id' => auth()->id(),
        ]);
        $this->file_upload_id = $file_upload->id;
        UploadPayrollNetidJob::dispatch($file_upload);
    }

    public function pollJob() {
        $job = JobHistory::where('user_id', auth()->id())
            ->where('name', 'UploadPayrollNetidJob')
            ->where('file_upload_id', '=', $this->file_upload_id)
            ->orderBy('created_at', 'desc')
            ->first();

        if ( $job ) {
            $this->job_status_text = $job->message;
            if ( $job->status === 'start' ) {
                $this->progress = 66;
            }

            if ( $job->status === 'complete' ) {
                $this->progress = 100;
            }

            if ( $job->status === 'error' ) {
                $this->job_error = true;
                $this->progress = 100;
            }
        }
    }

    public function render()
    {
        return view('livewire.upload-payroll-netid');
    }
}
