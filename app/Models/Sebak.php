<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sebak extends Model
{
    use HasFactory;
    protected $table = 'sebak';
    
    public function rituals()
    {
        return $this->belongsToMany(Ritual::class);
    }
}
