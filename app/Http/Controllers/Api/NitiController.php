<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Niti;
use App\Models\NitiManagement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class NitiController extends Controller
{
    
  
public function manageniti()
{
    $today = Carbon::today()->toDateString(); // Get today's date in 'Y-m-d' format

    $manage_niti = Niti::where('status', 'active')->get();
    
    if ($manage_niti->isEmpty()) {
        return response()->json([
            'status' => 200,
            'message' => 'No data found',
            'data' => []
        ], 200);
    }

    return response()->json([
        'status' => 200,
        'message' => 'Data retrieved successfully',
        'data' => $manage_niti
    ], 200);
}

public function start(Request $request)
{
    
    // Get authenticated user's sebak_id
    $sebak_id = Auth::guard('sebak_api')->user()->sebak_id;

    // Find the Niti by ID
    $niti = Niti::find($request->niti_id);
    if (!$niti) {
        return response()->json([
            'status' => 404,
            'message' => 'Niti not found',
            'data' => []
        ], 404);
    }

    // Set start time and other details
    $current_time = Carbon::now('Asia/Kolkata');
    
    // Create or update a record in NitiManagement table
    $nitiManagement = NitiManagement::create([
        'niti_id' => $request->niti_id,
        'sebak_id' => $sebak_id,
        'start_time' => $current_time,
        'niti_status' => 'started'
    ]);


    $niti->save();

    return response()->json([
        'status' => 200,
        'message' => 'Niti started successfully',
        'data' => $nitiManagement
    ], 200);
}
    

public function end(Request $request)
{
    $sebak_id = Auth::guard('sebak_api')->user()->sebak_id;

    // Find the Niti record by ID and Sebak ID
    $nitiManagement = NitiManagement::where('niti_id', $request->niti_id)
        ->where('sebak_id', $sebak_id)
        ->first();

    if (!$nitiManagement) {
        return response()->json([
            'status' => 404,
            'message' => 'Niti management record not found',
            'data' => []
        ], 404);
    }

    $current_time = Carbon::now('Asia/Kolkata');

    // Ensure `resume_time` is set
    if (!$nitiManagement->resume_time) {
        return response()->json([
            'status' => 500,
            'message' => 'Resume time is not set.',
            'data' => []
        ], 500);
    }

    // Calculate new duration from `resume_time` to current time
    $resume_time = Carbon::parse($nitiManagement->resume_time, 'Asia/Kolkata');
    $newDurationInSeconds = $current_time->diffInSeconds($resume_time);

    // Handle previous `running_time` (if set) and convert it to seconds
    $previousRunningTimeInSeconds = 0;
    if (!empty($nitiManagement->running_time) && $nitiManagement->running_time !== '00:00:00') {
        try {
            $previousRunningTime = Carbon::createFromFormat('H:i:s', $nitiManagement->running_time);
            $previousRunningTimeInSeconds = ($previousRunningTime->hour * 3600) +
                                            ($previousRunningTime->minute * 60) +
                                            $previousRunningTime->second;
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Invalid running time format',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Calculate the total duration in seconds
    $totalDurationInSeconds = $previousRunningTimeInSeconds + $newDurationInSeconds;

    // Format total duration into HH:MM:SS
    $formattedTotalDuration = gmdate('H:i:s', $totalDurationInSeconds);

    // Update the record with the calculated duration
    $nitiManagement->update([
        'niti_status' => 'completed',
        'end_time' => $current_time,
        'duration' => $formattedTotalDuration,
        'status' => 'completed'
    ]);

    return response()->json([
        'status' => 200,
        'message' => 'Niti completed successfully',
        'data' => $nitiManagement
    ], 200);
}


public function pause(Request $request)
{
    $sebak_id = Auth::guard('sebak_api')->user()->sebak_id;

    // Find the Niti record by ID and check if it exists
    $niti = NitiManagement::where('niti_id', $request->niti_id)
        ->where('sebak_id', $sebak_id)
        ->first();

    if (!$niti) {
        return response()->json([
            'status' => 404,
            'message' => 'Niti not found',
            'data' => []
        ], 404);
    }

    // Ensure start_time is set; otherwise, return an error
    if (is_null($niti->start_time)) {
        return response()->json([
            'status' => 400,
            'message' => 'Start time not set for this Niti',
            'data' => []
        ], 400);
    }

    $start_time = Carbon::parse($niti->start_time, 'Asia/Kolkata');
    $current_time = Carbon::now('Asia/Kolkata');

    // Calculate the running time duration from start_time to current time in seconds
    $durationInSeconds = $current_time->diffInSeconds($start_time);

    // Calculate hours, minutes, seconds from duration
    $hours = floor($durationInSeconds / 3600);
    $minutes = floor(($durationInSeconds % 3600) / 60);
    $seconds = $durationInSeconds % 60;

    // Format duration into HH:MM:SS
    $formattedDuration = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

    // Update the Niti record with pause information
    $niti->update([
        'niti_status' => 'paused',
        'pause_time' => $current_time,
        'running_time' => $formattedDuration, // Store running time formatted as HH:MM:SS
    ]);

    return response()->json([
        'status' => 200,
        'message' => 'Niti paused successfully',
        'data' => $niti
    ], 200);
}

public function resume(Request $request)
{
    $sebak_id = Auth::guard('sebak_api')->user()->sebak_id;

    // Find the Niti record by ID and Sebak ID
    $niti = NitiManagement::where('niti_id', $request->niti_id)
        ->where('sebak_id', $sebak_id)
        ->first();

    if (!$niti) {
        return response()->json([
            'status' => 404,
            'message' => 'Niti not found',
            'data' => []
        ], 404);
    }

    // Ensure the Niti is in a paused state
    if ($niti->niti_status !== 'paused') {
        return response()->json([
            'status' => 400,
            'message' => 'Niti is not paused, so it cannot be resumed',
            'data' => []
        ], 400);
    }

    // Set current time as the resume time and change status
    $current_time = Carbon::now('Asia/Kolkata');
    $niti->update([
        'niti_status' => 'started',
        'resume_time' => $current_time,
    ]);

    return response()->json([
        'status' => 200,
        'message' => 'Niti resumed successfully',
        'data' => $niti
    ], 200);
}



public function dailyritualtimg()
{
    $today = Carbon::today()->toDateString(); // Get today's date in 'Y-m-d' format

    $manage_niti = Niti::where('status', 'active')
        ->whereDate('niti_date', $today) // Filter by today's date
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'language' => $item->language,
                'niti_id' => $item->niti_id,
                'niti_type' => $item->niti_type,
                'niti_details' => $item->niti_name . ' at ' . $item->niti_time,
                'niti_date' => $item->niti_date,
                'start_time' => $item->start_time,
                'pause_time' => $item->pause_time,
                'running_time' => $item->running_time,
                'resume_time' => $item->resume_time,
                'end_time' => $item->end_time,
                'duration' => $item->duration,
                'description' => $item->description,
                'niti_status' => $item->niti_status,
                'status' => $item->status,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'created_by' => $item->created_by,
                'updated_by' => $item->updated_by
            ];
        });

    if ($manage_niti->isEmpty()) {
        return response()->json([
            'status' => 404,
            'message' => 'No Rituals Available Now',
            'data' => []
        ], 404);
    }

    return response()->json([
        'status' => 200,
        'message' => 'Rituals Available Now',
        'data' => $manage_niti
],200);
}

public function currentstatus()
{
    // Get the current time
    $currentTime = Carbon::now()->format('H:i');
    $today = Carbon::today()->toDateString();
   
    $current_niti = Niti::where('status', 'active')
        ->whereTime('niti_time', '<', $currentTime)
        ->whereDate('niti_date', $today) // Filter by current time
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'language' => $item->language,
                'niti_id' => $item->niti_id,
                'niti_type' => $item->niti_type,
                'niti_details' => $item->niti_name . ' at ' . $item->niti_time,
                'niti_date' => $item->niti_date,
                'start_time' => $item->start_time,
                'pause_time' => $item->pause_time,
                'running_time' => $item->running_time,
                'resume_time' => $item->resume_time,
                'end_time' => $item->end_time,
                'duration' => $item->duration,
                'description' => $item->description,
                'niti_status' => $item->niti_status,
                'status' => $item->status,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
                'created_by' => $item->created_by,
                'updated_by' => $item->updated_by
            ];
        });

    $upcoming_niti = Niti::where('status', 'active')
        ->where('niti_time', '>', $currentTime)
        ->whereDate('niti_date', $today)
        ->orderBy('niti_time', 'asc')
        ->first();

    $upcoming_niti_data = $upcoming_niti ? [
        'id' => $upcoming_niti->id,
        'language' => $upcoming_niti->language,
        'niti_id' => $upcoming_niti->niti_id,
        'niti_type' => $upcoming_niti->niti_type,
        'niti_details' => $upcoming_niti->niti_name . ' at ' . $upcoming_niti->niti_time,
        'niti_date' => $upcoming_niti->niti_date,
        'start_time' => $upcoming_niti->start_time,
        'pause_time' => $upcoming_niti->pause_time,
        'running_time' => $upcoming_niti->running_time,
        'resume_time' => $upcoming_niti->resume_time,
        'end_time' => $upcoming_niti->end_time,
        'duration' => $upcoming_niti->duration,
        'description' => $upcoming_niti->description,
        'niti_status' => $upcoming_niti->niti_status,
        'status' => $upcoming_niti->status,
        'created_at' => $upcoming_niti->created_at,
        'updated_at' => $upcoming_niti->updated_at,
        'created_by' => $upcoming_niti->created_by,
        'updated_by' => $upcoming_niti->updated_by
    ] : 'No upcoming rituals is available';

    $data = [
        'current_niti' => $current_niti,
        'upcoming_niti' => $upcoming_niti_data
    ];

    return response()->json([
        'status' => 200,
        'message' => 'Rituals Available Now',
        'data' => $data
],200);
}


}
