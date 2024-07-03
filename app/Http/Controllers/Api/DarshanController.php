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
                    'language' => $item->language,
                    'darshan_id' => $item->darshan_id,
                    'darshan_type' => $item->darshan_type,
                    'darshan_details' => $item->darshan_name . ' at ' . $item->darshan_time,
                    'darshan_date' => $item->darshan_date,
                    'start_time' => $item->start_time,
                    'pause_time' => $item->pause_time,
                    'running_time' => $item->running_time,
                    'resume_time' => $item->resume_time,
                    'end_time' => $item->end_time,
                    'duration' => $item->duration,
                    'description' => $item->description,
                    'darshan_status' => $item->darshan_status,
                    'status' => $item->status,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                    'created_by' => $item->created_by,
                    'updated_by' => $item->updated_by
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
