<?php

namespace App\Http\Controllers;
use App\Models\Niti;

use Illuminate\Http\Request;

class NitiController extends Controller
{
    
    public function manageniti(){
        $manage_niti = Niti::where('status', 'active')->get();
        return view('manageniti',compact('manage_niti'));
    }
    public function addniti(){
        return view('addniti');
    }

    public function saveNiti(Request $request)
    {
        // Validate the request inputs
        $request->validate([
            'niti_name' => 'required|string',
            'niti_type' => 'required|string|in:special,daily',
            'niti_time' => 'required|string',
            'language' => 'required|string',
        ]);
    
        // Create a new Niti instance
        $niti = new Niti();
        $niti->language = $request->input('language');
        $niti->niti_id = $request->input('niti_id');
        $niti->niti_name = $request->input('niti_name');
        $niti->niti_time = $request->input('niti_time');
        $niti->niti_ampm = $request->input('niti_ampm');
        $niti->niti_type = $request->input('niti_type');
        $niti->description = $request->input('description');
    
        // Handle created_by and updated_by columns
        $niti->created_by = auth()->user()->id;
        $niti->updated_by = auth()->user()->id;
    
        // Save the Niti instance to the database
        if ($niti->save()) {
            return redirect()->back()->with('success', 'Niti data saved successfully.');
        } else {
            return redirect()->back()->withErrors(['danger' => 'Failed to save Niti data.']);
        }
    }
    

    
    
    public function deletNiti($niti_id)
    {
        $affected = Niti::where('niti_id', $niti_id)
                        ->update(['status' => 'deleted']);
        if ($affected) {
            return redirect()->back()->with('success', 'Data deleted successfully.');
        } else {
            return redirect()->back()->with('danger', 'Data deletion unsuccessful.');
        }
    }
    public function editNiti($id)
    {
        $niti = Niti::where('id', $id)->first();

        return view('updateniti', compact('niti'));
    }
    
  
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'niti_name' => 'required|string',
            'niti_time' => 'required|string',
            'niti_type' => 'required|string|in:special,daily',
            'language' => 'required|string',
        ]);
    
        // Find the Niti by its ID or return null if not found
        $niti = Niti::find($id);
    
        // If Niti not found, return error response
        if (!$niti) {
            return response()->json(['error' => 'Niti not found'], 404);
        }
    
        // Update Niti data
        $niti->language = $request->input('language');
        $niti->niti_name = $request->input('niti_name');
        $niti->description = $request->input('description');
        $niti->niti_time = $request->input('niti_time') . ' ' . $request->input('niti_ampm'); // Combine time and AM/PM
        $niti->niti_type = $request->input('niti_type');
    
        // Update the updated_by field with the ID of the currently logged-in user
        $niti->updated_by = auth()->user()->id;
    
        // Save changes
        if ($niti->save()) {
            return redirect()->route('manageniti')->with('success', 'Data updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update data.');
        }
    }
     
}
