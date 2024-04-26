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
    public function saveNiti(Request $request){
        $request->validate([
            'niti_name' => 'required|string',
            'description' => 'required|string',
        ]);
        $niti = new Niti();
        $niti->niti_id = $request->niti_id;
        $niti->niti_name = $request->niti_name;
        $niti->description = $request->description;

        if ($niti->save()) {
            return redirect()->back()->with('success', 'Data saved successfully.');
        } else {
            return redirect()->back()->withErrors(['danger' => 'Failed to save data.']);
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
        
           // Find the Niti or return null if not found
           $niti = Niti::find($id);

           // If Niti not found, return error response
           if (!$niti) {
               return response()->json(['error' => 'Niti not found'], 404);
           }
       
           // Update Niti data
           $niti->niti_name = $request->niti_name;
           $niti->description = $request->description;
       
           // Save changes
           if ($niti->save()) {
               return redirect()->back()->with('success', 'Data updated successfully.');
           } else {
               return redirect()->back()->with('error', 'Failed to update data.');
           }
       }
      
}
