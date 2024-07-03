<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Darshan;
use Carbon\Carbon;

class DarshanController extends Controller
{
    public function manageDarshan()
{
    $today = Carbon::today()->toDateString(); // Get today's date in 'Y-m-d' format

    $darshan = Darshan::where('status', 'active')
    ->whereDate('darshan_date', $today) // Filter by today's date
    ->get();

    if ($darshan->isEmpty()) {
        return response()->json([
            'status' => 404,
            'message' => 'Darshan is not available',
            'data' => []
        ], 404);
    }

    return response()->json([
        'status' => 200,
        'message' => 'Darshan is available now',
        'data' => $darshan
    ], 200);

}

public function currentDarshan(Request $request)
    {
        // Get the current date and time
        $currentDate = Carbon::now()->toDateString(); // Format: Y-m-d
        $currentTime = Carbon::now()->format('H:i');  // Format: HH:MM
        
        // Query to find active darshans for today that are currently live
        $current_darshan = Darshan::where('status', 'active')
            ->whereDate('darshan_date', $currentDate)
            ->whereTime('darshan_start_time', '<=', $currentTime)
            ->whereTime('darshan_stop_time', '>=', $currentTime)
            ->first(); // Using first() to get a single record
            
            if ($current_darshan) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Darshan is not available',
                    'data' => $current_darshan
                ], 200);
              
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => 'Darshan is available now',
                    'data' => []
                ], 404);
            }
        
          
        
    }

  
}
