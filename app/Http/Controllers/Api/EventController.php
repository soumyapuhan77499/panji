<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function manageevent()
    {
        $manageevents = Event::where('status', 'active')->get();
        
        return response()->json(['manageevents' => $manageevents]);
    }
}
