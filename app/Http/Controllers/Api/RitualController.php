<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ritual;


class RitualController extends Controller
{
    public function manageritual()
    {
        $manage_ritual = Ritual::where('status', 'active')->get();
        
        return response()->json(['manage_ritual' => $manage_ritual]);
    }
}
