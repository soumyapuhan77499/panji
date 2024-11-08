<?php

namespace App\Http\Controllers;
use App\Models\Sebaklogin;
use App\Models\SebaMaster;
use App\Models\SebayatMaster;
use App\Models\SebaStep;

use Illuminate\Http\Request;

class SebakController extends Controller
{
    public function managesebak(){
        $manage_sebak = Sebaklogin::where('status', 'active')->get();
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
        $sebak = new Sebaklogin();
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
        $affected = Sebaklogin::where('sebak_id', $sebak_id)->update(['status' => 'deleted']);
                        
        if ($affected) {
            return redirect()->back()->with('success', 'Data deleted successfully.');
        } else {
            return redirect()->back()->with('danger', 'Data deletion unsuccessful.');
        }
    }

    public function editSebak($sebak_id)
    {
        $sebak = Sebaklogin::where('sebak_id', $sebak_id)->first();

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
        $sebak = Sebaklogin::findOrFail($id);  // Fetch the existing record, or fail if not found
    
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


    // seba controller start here

    public function manageSeba()
    {
        // Fetch SebaMaster records with their associated SebaStep records
        $manage_seba = SebaMaster::where('status', 'active')->with('steps')->get();
        return view('manage-seba', compact('manage_seba'));
    }
    

    public function addSeba(){
        return view('add-seba');
    }

    public function editSeba($id)
    {
        $seba = SebaMaster::findOrFail($id);
        return view('edit-seba', compact('seba'));
    }
    

   
public function saveSeba(Request $request)
{
    // Validate the incoming data
    $request->validate([
        'seba_name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'step_of_seba' => 'required|array',
        'step_of_seba.*' => 'string|max:255',
    ]);

    // Save data to the SebaMaster model
    $seba = new SebaMaster();
    $seba->language = $request->input('language');
    $seba->seba_name = $request->input('seba_name');
    $seba->description = $request->input('description');
    $seba->save();

    // Loop through each step and save it in the SebaStep model
    foreach ($request->input('step_of_seba') as $step) {
        $sebaStep = new SebaStep();
        $sebaStep->seba_id = $seba->id;
        $sebaStep->step_name = $step;
        $sebaStep->save();
    }

    // Redirect with a success message
    return redirect()->back()->with('success', 'Seba and steps saved successfully!');
}
public function updateSeba(Request $request, $id)
{
    // Validate incoming data
    $request->validate([
        'seba_name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'step_of_seba' => 'nullable|array', // Ensure steps are an array
        'step_of_seba.*' => 'string|max:255', // Each step should be a string
    ]);

    // Update the main SebaMaster entry
    $seba = SebaMaster::findOrFail($id);
    $seba->language = $request->input('language');
    $seba->seba_name = $request->input('seba_name');
    $seba->description = $request->input('description');
    $seba->save();

    // Retrieve the existing steps for the Seba
    $existingSteps = $seba->steps; // Assuming the SebaMaster model has a `steps` relationship
    $newSteps = $request->input('step_of_seba', []);

    // Track updated or new steps by ID to retain them
    $updatedStepIds = [];

    foreach ($newSteps as $index => $stepName) {
        if (isset($existingSteps[$index])) {
            // Update existing step
            $existingSteps[$index]->update([
                'step_name' => $stepName,
            ]);
            $updatedStepIds[] = $existingSteps[$index]->id;
        } else {
            // Create new step
            $newStep = $seba->steps()->create([
                'step_name' => $stepName,
                'seba_id' => $seba->id, // Associate with SebaMaster
            ]);
            $updatedStepIds[] = $newStep->id;
        }
    }

    // Remove steps that are no longer in the updatedStepIds list
    $seba->steps()->whereNotIn('id', $updatedStepIds)->delete();

    // Redirect with a success message
    return redirect()->route('manageSeba')->with('success', 'Seba updated successfully!');
}



public function deleteSeba($id)
{
    // Find the Niti record
    $niti = SebaMaster::findOrFail($id);

    // Update the status to 'deleted'
    $niti->status = 'deleted';
    $niti->save();

    // Redirect with a success message
    return redirect()->route('manageSeba')->with('success', 'Seba deleted successfully!');
}

     

   // sebayat controller start here

   public function manageSebayat(){
    $manage_sebayat = SebayatMaster::where('status', 'active')->get();
    return view('manage-sebayat',compact('manage_sebayat'));
}

public function addSebayat(){
    return view('add-sebayat');
}

public function editSebayat($id)
{
    $sebayat = SebayatMaster::findOrFail($id);
    return view('edit-sebayat', compact('sebayat'));
}

public function saveSebayat(Request $request)
{
    // Validate the incoming data
    $request->validate([
        'sebayat_name' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    // Save data to the Niti model
    $niti = new SebayatMaster();
    $niti->sebayat_name = $request->input('sebayat_name');
    $niti->description = $request->input('description');
    $niti->save();

    // Redirect with a success message
    return redirect()->back()->with('success', 'Sebayat saved successfully!');
}


public function updateSebayat(Request $request, $id)
{
// Validate incoming data
$request->validate([
    'sebayat_name' => 'required|string|max:255',
    'description' => 'nullable|string',
]);

// Update the existing Niti entry
$niti = SebayatMaster::findOrFail($id);
$niti->sebayat_name = $request->input('sebayat_name');
$niti->description = $request->input('description');
$niti->save();

// Redirect with a success message
return redirect()->route('manageSebayat')->with('success', 'Sebayat updated successfully!');
}

public function deleteSebayat($id)
{
// Find the Niti record
$niti = SebayatMaster::findOrFail($id);

// Update the status to 'deleted'
$niti->status = 'deleted';
$niti->save();

// Redirect with a success message
return redirect()->route('manageSebayat')->with('success', 'Sebayat deleted successfully!');
}


}
