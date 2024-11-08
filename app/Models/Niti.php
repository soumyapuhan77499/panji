<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niti extends Model
{
    use HasFactory;

    protected $table = 'niti';

    protected $fillable = [
        'language',
        'niti_id',
        'niti_type',
        'niti_name',
        'niti_time',
        'description',
        'status'
    ];
    
    public function rituals()
    {
        return $this->belongsToMany(Ritual::class);
    }
}
