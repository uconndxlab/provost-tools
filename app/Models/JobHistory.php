<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobHistory extends Model
{
    use HasFactory;

    protected $table = 'job_history';

    protected $fillable = [
        'name',
        'status',
        'message',
        'user_id',
        'file_upload_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fileUpload()
    {
        return $this->belongsTo(FileUpload::class);
    }
}
