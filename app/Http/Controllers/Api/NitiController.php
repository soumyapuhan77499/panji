<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Niti;
use Carbon\Carbon;


class NitiController extends Controller
{
    public function dailyritualtimg()
{
    $today = Carbon::today()->toDateString(); // Get today's date in 'Y-m-d' format

    $manage_niti = Niti::where('status', 'active')
    ->whereDate('niti_date', $today) // Filter by today's date
    ->get();

    if ($manage_niti->isEmpty()) {
        return response()->json([
            'status' => 404,
            'message' => 'No data found',
            'data' => []
        ], 404);
    }

    return response()->json([
        'status' => 200,
        'message' => 'Data retrieved successfully',
        'data' => $manage_niti
    ], 200);
}

public function currentstatus()
{
    // Get the current time
    $currentTime = Carbon::now()->format('H:i');

    // Retrieve data from the database where status is active and start_time matches the current time
    $current_niti = Niti::where('status', 'active')
        ->whereTime('niti_time', $currentTime) // Filter by current time
        ->get();

    $upcoming_niti = Niti::where('status', 'active')
        ->where('niti_time', '>', $currentTime)
        ->orderBy('niti_time', 'asc')
        ->first();

        $data = [
            'current_niti' => $current_niti,
            'upcoming_niti' => $upcoming_niti
        ];
    
        if (is_null($current_niti) && is_null($upcoming_niti)) {
            return response()->json([
                'status' => 404,
                'message' => 'No current or upcoming niti found',
                'data' => $data
            ], 404);
        }
    
        return response()->json([
            'status' => 200,
            'message' => 'Niti data retrieved successfully',
            'data' => $data
], 200);
}
    public function start(Request $request)
    {
        $niti = Niti::find($request->niti_id);
    
        if (!$niti) {
            return response()->json([
                'status' => 404,
                'message' => 'Niti not found',
                'data' => []
            ], 404);
        }
    
        $current_time = Carbon::now('Asia/Kolkata');
        $niti->niti_status = 'started';
        $niti->start_time = $current_time;
        $niti->save();
    
        return response()->json([
            'status' => 200,
            'message' => 'Niti started successfully',
            'data' => $niti
        ], 200);
    }
    

    public function end(Request $request)
    {
        $niti = Niti::find($request->niti_id);
    
        if (!$niti) {
            return response()->json([
                'status' => 404,
                'message' => 'Niti not found',
                'data' => []
            ], 404);
        }
    
        $current_time = Carbon::now('Asia/Kolkata');
    
        // Retrieve resume_time
        $resume_time = Carbon::parse($niti->resume_time, 'Asia/Kolkata');
    
        // Calculate new duration in seconds
        $newDurationInSeconds = $current_time->diffInSeconds($resume_time);
    
        // Retrieve and parse previous running time
        $previousRunningTime = Carbon::createFromFormat('H:i:s', $niti->running_time);
        $previousRunningTimeInSeconds = ($previousRunningTime->hour * 3600) + ($previousRunningTime->minute * 60) + $previousRunningTime->second;
    
        // Calculate total duration in seconds
        $totalDurationInSeconds = $previousRunningTimeInSeconds + $newDurationInSeconds;
    
        // Calculate hours, minutes, seconds
        $hours = floor($totalDurationInSeconds / 3600);
        $minutes = floor(($totalDurationInSeconds % 3600) / 60);
        $seconds = $totalDurationInSeconds % 60;
    
        // Format total duration into HH:MM:SS
        $formattedTotalDuration = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    
        // Update niti attributes
        $niti->niti_status = 'completed';
        $niti->end_time = $current_time;
        $niti->duration = $formattedTotalDuration;
        $niti->save();
    
        return response()->json([
            'status' => 200,
            'message' => 'Niti completed successfully',
            'data' => $niti
        ], 200);
    }
    

public function pause(Request $request)
{
    $niti = Niti::find($request->niti_id);

    if (!$niti) {
        return response()->json([
            'status' => 404,
            'message' => 'Niti not found',
            'data' => []
        ], 404);
    }

    // Assuming 'start_time' is stored as a time string like "12:17:31"
    $start_time = Carbon::parse($niti->start_time, 'Asia/Kolkata');

    // Calculate current time in the same format as start_time
    $current_time = Carbon::now('Asia/Kolkata');
    // Calculate running time duration in seconds
    $durationInSeconds = $current_time->diffInSeconds($start_time);

    // Calculate hours, minutes, seconds
    $hours = floor($durationInSeconds / 3600);
    $minutes = floor(($durationInSeconds % 3600) / 60);
    $seconds = $durationInSeconds % 60;

    // Format duration into HH:MM:SS
    $formattedDuration = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

    // Update niti attributes
    $niti->niti_status = 'paused';
    $niti->pause_time = $current_time;
    $niti->running_time = $formattedDuration; // Store running time formatted as HH:MM:SS
    $niti->save();

    return response()->json([
        'status' => 200,
        'message' => 'Niti paused successfully',
        'data' => $niti
    ], 200);
}


public function resume(Request $request)
{
    $niti = Niti::find($request->niti_id);

    if (!$niti) {
        return response()->json([
            'status' => 404,
            'message' => 'Niti not found',
            'data' => []
        ], 404);
    }

    $current_time = Carbon::now('Asia/Kolkata');
    $niti->niti_status = 'started';
    $niti->resume_time = $current_time;
    $niti->save();

    return response()->json([
        'status' => 200,
        'message' => 'Niti resumed successfully',
        'data' => $niti
    ], 200);
}

public function manageniti()
{
    $today = Carbon::today()->toDateString(); // Get today's date in 'Y-m-d' format

    $manage_niti = Niti::where('status', 'active')
    ->whereDate('niti_date', $today) // Filter by today's date
    ->get();

    if ($manage_niti->isEmpty()) {
        return response()->json([
            'status' => 404,
            'message' => 'No data found',
            'data' => []
        ], 404);
    }

    return response()->json([
        'status' => 200,
        'message' => 'Data retrieved successfully',
        'data' => $manage_niti
    ], 200);
}

}
