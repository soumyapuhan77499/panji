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
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'darshan_date' => $item->darshan_date,
                    'darshan_details' => $item->darshan_name . ' at ' . $item->darshan_start_time,
                    'darshan_stop_time' => $item->darshan_stop_time,
                    'status' => $item->status,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at
                ];
            });
    
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
],200);
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
            $current_darshan = [
                'id' => $current_darshan->id,
                'darshan_date' => $current_darshan->darshan_date,
                'darshan_details' => $current_darshan->darshan_name . ' at ' . $current_darshan->darshan_start_time,
                'darshan_stop_time' => $current_darshan->darshan_stop_time,
                'status' => $current_darshan->status,
                'created_at' => $current_darshan->created_at,
                'updated_at' => $current_darshan->updated_at
            ];
    
            return response()->json([
                'status' => 200,
                'message' => 'Darshan is available now',
                'data' => $current_darshan
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Darshan is not available',
                'data' => []
            ],404);
    }
    }
  
}
