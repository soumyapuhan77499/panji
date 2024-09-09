<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens; // Add this

class Sebaklogin extends Model
{
    use HasFactory, HasApiTokens; // Include HasApiTokens trait
    protected $table = 'sebak_login';
    protected $fillable = [
        'user_id',        // Add user_id to the fillable array
        'mobile_no',      // Add all the fields that you're mass-assigning
        'order_id',
        'client_id',
        'client_secret',
        'otp_length',
        'channel',
        'expiry',
        'hash',
    ];
}