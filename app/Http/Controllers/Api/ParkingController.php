<?php
namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\Niti;
use App\Models\Notice;
use App\Models\Parking;
use App\Models\Youtube;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParkingController extends Controller
{
    public function parkingApp()
    {
        $today = Carbon::today()->toDateString(); // Get today's date in 'Y-m-d' format

        // Get current niti (object)
        $current_niti = Niti::where('status', 'active')
            ->where('niti_status', 'started')
            ->where('language', 'english')
            ->whereDate('niti_date', $today)
            ->first(); // Get a single record

        // Get active notices (object)
        $notices = Notice::where('status', 'active')
              ->where('language', 'english')
            ->orderBy('created_at', 'desc')
            ->first(); // Get a single record

        // Get active parking details (array)
        $parkings = Parking::where('status', 'active')
             ->where('language', 'english')
            ->orderBy('created_at', 'desc')
            ->get(); // Get all records

        foreach ($parkings as $parking) {
            $parking->parking_photo_url = asset($parking->parking_photo);
        }

        // Get active YouTube URLs (array)
        $youtube_urls = Youtube::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get(); // Get all records

        // Create object and array structures
        $objectData = (object) [
            'current_niti' => $current_niti,
            'notices' => $notices,
        ];

        // Combine into final $data object
        $data = (object) [
            'current_niti' => $current_niti,
            'notices' => $notices,
            'parking' => $parkings->toArray(), // Convert parking collection to array
            'youtube_urls' => $youtube_urls->toArray(), // Convert youtube_urls collection to array
        ];



        // Get current niti (object)
        $current_niti_odia = Niti::where('status', 'active')
            ->where('niti_status', 'started')
            ->where('language', 'odia')
            ->whereDate('niti_date', $today)
            ->first(); // Get a single record

        // Get active notices (object)
        $notices_odia = Notice::where('status', 'active')
             ->where('language', 'odia')
            ->orderBy('created_at', 'desc')
            ->first(); // Get a single record

        // Get active parking details (array)
        $parkings_odia = Parking::where('status', 'active')
            ->where('language', 'odia')
            ->orderBy('created_at', 'desc')
            ->get(); // Get all records

        foreach ($parkings_odia as $parking) {
            $parking->parking_photo_url = asset($parking->parking_photo);
        }

        // Get active YouTube URLs (array)
        $youtube_urls = Youtube::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get(); // Get all records

        // Create object and array structures
        $objectData = (object) [
            'current_niti' => $current_niti,
            'notices' => $notices,
        ];

        // Combine into final $data object
        $data_odia = (object) [
            'current_niti_odia' => $current_niti_odia,
            'notices_odia' => $notices_odia,
            'parkings_odia' => $parkings_odia->toArray(), // Convert parking collection to array
            'youtube_urls' => $youtube_urls->toArray(), // Convert youtube_urls collection to array
        ];

        // Check if any data is missing
        if (is_null($current_niti_odia) && is_null($notices_odia) && empty($parkings_odia) && empty($youtube_urls)) {
            return response()->json([
                'status' => 404,
                'message' => 'No data found',
                'data' => $data
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Data retrieved successfully',
            'data' => $data,
            'data_odia' => $data_odia
        ],200);
}
}