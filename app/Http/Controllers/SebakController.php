<?php

namespace App\Http\Controllers;
use App\Models\Nitilogin;

use Illuminate\Http\Request;

class SebakController extends Controller
{
    public function managesebak(){
        $manage_sebak = Nitilogin::where('status', 'active')->get();
        return view('managesebak',compact('manage_sebak'));
    }

    public function addsebak(){
        return view('addsebak');
    }

    public function saveSebak(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'sebak_name' => 'required|string',
            'mobile_no' => 'required|numeric',
            'email' => 'required|email',
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validating image upload
        ]);
    
        // Handle the file upload for the profile photo
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = 'uploads/profile_photos/' . $fileName; // Set the correct file path
            $file->move(public_path('uploads/profile_photos'), $fileName); // Store the file in a public directory
        }
    
        // Create a new Sebak login entry
        $sebak = new Nitilogin();
        $sebak->sebak_id = $request->sebak_id;
        $sebak->name = $request->sebak_name;
        $sebak->mobile_no = '+91' . $request->mobile_no;
        $sebak->email = $request->email;
        $sebak->profile_photo = isset($filePath) ? $filePath : null; // Save the correct file path in the database
    
        // Save data to the database
        if ($sebak->save()) {
            return redirect()->back()->with('success', 'Data saved successfully.');
        } else {
            return redirect()->back()->withErrors(['danger' => 'Failed to save data.']);
        }
    }
    

    public function deletSebak($sebak_id)
    {
        $affected = Nitilogin::where('sebak_id', $sebak_id)->update(['status' => 'deleted']);
                        
        if ($affected) {
            return redirect()->back()->with('success', 'Data deleted successfully.');
        } else {
            return redirect()->back()->with('danger', 'Data deletion unsuccessful.');
        }
    }

    public function editSebak($sebak_id)
    {
        $sebak = Nitilogin::where('sebak_id', $sebak_id)->first();

        return view('updatesebak', compact('sebak'));
    }

    public function update(Request $request, $id)
    {
        // Validate inputs
        $request->validate([
            'sebak_name' => 'required|string',
            'mobile_no' => 'required|numeric|digits:10',
            'email' => 'required|email',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image upload
        ]);
    
        // Find the existing Sebak by ID
        $sebak = Nitilogin::findOrFail($id);  // Fetch the existing record, or fail if not found
    
        // Handle the file upload for the profile photo if provided
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = 'uploads/profile_photos/' . $fileName;
            $file->move(public_path('uploads/profile_photos'), $fileName); // Move file to public directory
            $sebak->profile_photo = $filePath; // Update profile photo path if a new photo is uploaded
        }
    
        // Update other fields
        $sebak->sebak_id = $request->sebak_id;
        $sebak->name = $request->sebak_name;
        $sebak->mobile_no = '+91' . $request->mobile_no; // Add +91 prefix to the mobile number
        $sebak->email = $request->email;
    
        // Save changes to the database
        if ($sebak->save()) {
            return redirect()->back()->with('success', 'Data updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update data.');
        }
    }
    
}
