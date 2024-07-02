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
            'message' => 'No data found',
            'data' => []
        ], 404);
    }

    return response()->json([
        'status' => 200,
        'message' => 'Data retrieved successfully',
        'data' => $darshan
    ], 200);

}

public function currentDarshan(){
    $darshan = Darshan::where('status', 'active')
    ->whereDate('darshan_date', $today) // Filter by today's date
    ->get();

}

  
}
