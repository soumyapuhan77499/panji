<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niti extends Model
{
    use HasFactory;
    protected $table = 'niti';

    protected $fillable = [
        'niti_id', 
        'niti_name', 
        'description', 
        'niti_date', 
        'niti_time'
    ];
    
    public function rituals()
    {
        return $this->belongsToMany(Ritual::class);
    }
}
