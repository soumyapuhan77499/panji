<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sebak;

class SebakController extends Controller
{
    public function managesebak()
    {
        $manage_sebak = Sebak::where('status', 'active')->get();
        
        return response()->json(['manage_sebak' => $manage_sebak]);
    }
}
