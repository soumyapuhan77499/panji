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

        $current_time = Carbon::now('Asia/Kolkata');

        if (!$niti) {
            return response()->json(['message' => 'Niti not found'], 404);
        }

        $niti->niti_status = 'started';
        $niti->start_time = $current_time;
        $niti->save();

        return response()->json(['message' => 'Niti started successfully', 'niti' => $niti]);
    }

    public function end(Request $request)
    {
        $niti = Niti::find($request->niti_id);

        if (!$niti) {
            return response()->json(['message' => 'Niti not found'], 404);
        }

        $current_time = Carbon::now('Asia/Kolkata');

        $niti->niti_status = 'completed';
        $niti->end_time = $current_time;
        // Calculate duration in seconds
        $niti->duration = $request->duration;
        $niti->save();

        return response()->json(['message' => 'Niti completed successfully', 'niti' => $niti]);
    }

    public function pause(Request $request)
    {
        $niti = Niti::find($request->niti_id);
        if (!$niti) {
            return response()->json(['message' => 'Niti not found'], 404);
        }
        $current_time = Carbon::now('Asia/Kolkata');

        $niti->niti_status = 'paused';
        $niti->pause_time = $current_time;
        $niti->save();

        return response()->json(['message' => 'Niti paused successfully', 'niti' => $niti]);
    }

    public function resume(Request $request)
    {
        $niti = Niti::find($request->niti_id);
        if (!$niti) {
            return response()->json(['message' => 'Niti not found'], 404);
        }
        $current_time = Carbon::now('Asia/Kolkata');

        $niti->niti_status = 'started';
        $niti->resume_time = $current_time;
        $niti->save();

        return response()->json(['message' => 'Niti resumed successfully', 'niti' => $niti]);
    }

    public function manageniti()
    {
        $manage_niti = Niti::where('status', 'active')->get();
        
        return response()->json(['manage_niti' => $manage_niti]);
    }
}
