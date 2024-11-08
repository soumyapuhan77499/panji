<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NitiManagement extends Model
{
    use HasFactory;

    protected $table = 'niti_management';

    protected $fillable = [
        'niti_id',
        'sebak_id',
        'start_time',
        'pause_time',
        'running_time',
        'resume_time',
        'end_time',
        'duration',
        'niti_status'
    ];

 
}
