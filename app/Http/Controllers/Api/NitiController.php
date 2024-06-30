<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Niti;
use Carbon\Carbon;


class NitiController extends Controller
{
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

    $niti->niti_status = 'completed';
    $niti->end_time = $current_time;
    // Calculate duration in seconds
    $niti->duration = $request->duration;
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

    $current_time = Carbon::now('Asia/Kolkata');
    $niti->niti_status = 'paused';
    $niti->pause_time = $current_time;
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
