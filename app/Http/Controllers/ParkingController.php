<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;

class ParkingController extends Controller
{
    public function parking(){
        return view('parking');
    }
    public function manageParking(){

        $parkings = Parking::where('status', 'active')->get();

        return view('manageparking', compact('parkings'));

    }

    public function saveParking(Request $request)
    {
        // Validate the request
        $request->validate([
            'notice' => 'required|string|max:255',
            'availability' => 'required|string|max:255',
            'map_url' => 'nullable|url',
            'parking_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parking_address' => 'required|string',
            'vehicle_type' => 'required|string|in:two_wheeler,four_wheeler',
        ]);
    
        // Handle the file upload
        $photoPath = null;
        if ($request->hasFile('parking_photo')) {
            // Store the file and get the path
            $photoPath = $request->file('parking_photo')->store('parking_photos', 'public');
    
            // Additional manual file move (if needed)
            $file = $request->file('parking_photo');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move(public_path('assets/uploads/parking_photo'), $filename);
    
            // Update photoPath with the manually moved file path
            $photoPath = 'assets/uploads/parking_photo/' . $filename;
        }
    
        // Create a new Parking record
        $parking = new Parking();
        $parking->language = $request->language;
        $parking->parking_name = $request->notice;
        $parking->parking_availability = $request->availability;
        $parking->map_url = $request->map_url;
        $parking->parking_photo = $photoPath;
        $parking->parking_address = $request->parking_address;
        $parking->vehicle_type = $request->vehicle_type;
        $parking->save();
    
        // Redirect back or to a success page
        return redirect()->back()->with('success', 'Parking saved successfully!');
    }
    
}
