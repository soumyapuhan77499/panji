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
            ->whereDate('niti_date', $today)
            ->first(); // Get a single record

        // Get active notices (object)
        $notices = Notice::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->first(); // Get a single record

        // Get active parking details (array)
        $parkings = Parking::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get(); // Get all records

            foreach ($parkings as $parking) {
                $parking->parking_photo_url = asset( $parking->parking_photo);
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

        $arrayData = [
            'parking' => $parking,
            'youtube_urls' => $youtube_urls,
        ];

        // Combine into final $data object
        $data = (object) array_merge((array) $objectData, $arrayData);

        // Check if any data is missing
        if (is_null($current_niti) && is_null($notices) && empty($parking) && empty($youtube_urls)) {
            return response()->json([
                'status' => 404,
                'message' => 'No data found',
                'data' => $data
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Data retrieved successfully',
            'data' => $data
        ], 200);
    }
}
