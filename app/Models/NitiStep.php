<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NitiStep extends Model
{
    use HasFactory;

    protected $table = 'niti_step';

    protected $fillable = ['niti_id', 'step_name', 'status'];
}
