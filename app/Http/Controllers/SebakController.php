<?php

namespace App\Http\Controllers;
use App\Models\Sebak;

use Illuminate\Http\Request;

class SebakController extends Controller
{
    public function managesebak(){
        $manage_sebak = Sebak::where('status', 'active')->get();
        return view('managesebak',compact('manage_sebak'));
      
    }
    public function addsebak(){
        return view('addsebak');
    }
    public function saveSebak(Request $request){
        $request->validate([
            'sebak_name' => 'required|string',
            'description' => 'required|string',
        ]);
        $sebak = new Sebak();
        $sebak->sebak_id = $request->sebak_id;
        $sebak->sebak_name = $request->sebak_name;
        $sebak->description = $request->description;

        if ($sebak->save()) {
            return redirect()->back()->with('success', 'Data saved successfully.');
        } else {
            return redirect()->back()->withErrors(['danger' => 'Failed to save data.']);
        }
       
    }
    public function deletSebak($sebak_id)
    {
        $affected = Sebak::where('sebak_id', $sebak_id)
                        ->update(['status' => 'deleted']);
        if ($affected) {
            return redirect()->back()->with('success', 'Data deleted successfully.');
        } else {
            return redirect()->back()->with('danger', 'Data deletion unsuccessful.');
        }
    }
    public function editSebak($sebak_id)
    {
        $sebak = Sebak::where('sebak_id', $sebak_id)->first();

        return view('updatesebak', compact('sebak'));
    }
    public function update(Request $request, $id)
    {
        // Find the Niti or return null if not found
        $sebak = Sebak::find($id);

        // If Niti not found, return error response
        if (!$sebak) {
            return response()->json(['error' => 'Sebak not found'], 404);
        }
    
        // Update Niti data
        $sebak->sebak_name = $request->sebak_name;
        $sebak->description = $request->description;
    
        // Save changes
        if ($sebak->save()) {
            return redirect()->back()->with('success', 'Data updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update data.');
        }
    }
    

}
