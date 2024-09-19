<div>
    <form wire:submit="submitted">
        @csrf

        @error('uploading_file')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror

        <div class="row g-3 align-items-center mb-3">
            <div class="col-auto">
              <input type="file" id="userCsv" class="form-control" aria-describedby="uploadUserCSVHelp" wire:model="uploading_file" accept=".csv" >
            </div>
            <div class="col-auto">
                <span id="uploadUserCSVHelp" class="form-text">
                    This file is expected to consist of two columns: payroll_id and netid.  Must contain those headers.
                </span>
            </div>
        </div>

        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <button type="submit" class="btn btn-primary" @disabled($progress > 0)>Initiate Upload</button>
            </div>
            <div class="col-2">
                @if ( $progress > 0 && $progress < 100 )
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="false"></span>
                @endif
                <span>{{ $job_status_text }}</span>
            </div>
            <div class="col">
                @if ( $progress > 0 )
                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100" @if ($progress !== 100) wire:poll="pollJob" @endif>
                    <div @class(['progress-bar', 'bg-danger' => $job_error]) style="width: {{ $progress }}%"></div>
                </div>
                @endif
            </div>
        </div>
    </form>
</div>
