<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'event';
    protected $fillable = ['date', 'event_name', 'tithi', 'good_time', 'bad_time', 'sun_rise', 'sun_set', 'special_niti', 'event_photo'];
}
