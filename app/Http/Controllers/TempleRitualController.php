<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ritual;
use App\Models\Niti;
use App\Models\Sebak;

class TempleRitualController extends Controller
{
    public function manageritual(){
        $manage_ritual = Ritual::where('status', 'active')->get();
        return view('managetempleritual',compact('manage_ritual'));
    }
    public function addritual(){
        $nitis = Niti::where('status', 'active')->get();
        $sebaks = Sebak::where('status', 'active')->get();

        return view('addtempleritual', compact('nitis', 'sebaks'));
    }
    public function saveRitual(Request $request){
        $request->validate([
            'ritual_name' => 'required|string',
            'time' => 'required|string',
            'niti_name' => 'required|array', // Ensure niti_name is an array
            'niti_name.*' => 'string', // Validate each niti_name value
        ]);

      
        $ritual = new Ritual();
    
        $ritual->ritual_id = $request->ritual_id;
        $ritual->ritual_name = $request->ritual_name;
        $ritual->date = $request->date;
        $ritual->time = $request->time;
        $ritual->description = $request->description;
        
        $nitinames = $request->input('niti_name');
   
            $nitinamesString = implode(',', $nitinames);
            $ritual->niti_name = $nitinamesString;
      
            $sebaknames = $request->input('sebak_name');

            $sebaknamesString = implode(',', $sebaknames);
            $ritual->sebak_name = $sebaknamesString;
      
        if ($ritual->save()) {
            return redirect()->back()->with('success', 'Data saved successfully.');
        } else {
            return redirect()->back()->withErrors(['danger' => 'Failed to save data.']);
        } 
    }
    
    
    public function deletRitual($ritual_id)
    {
        $affected = Ritual::where('ritual_id', $ritual_id)
                        ->update(['status' => 'deleted']);
        if ($affected) {
            return redirect()->back()->with('success', 'Data deleted successfully.');
        } else {
            return redirect()->back()->with('danger', 'Data deletion unsuccessful.');
        }
    }
    
    public function editRitual($id)
    {
        $ritual = Ritual::findOrFail($id);
        $nitis = Niti::where('status', 'active')->get();
        $sebaks = Sebak::where('status', 'active')->get();
        return view('updatetempleritual', compact('ritual', 'nitis', 'sebaks'));
       
    }

    public function update(Request $request, $id)
    {
    
        // Validate the request data
       $request->validate([
            'ritual_name' => 'required|string',
            'time' => 'required|string',
            'description' => 'nullable|string',
        ]);
    
        $ritual = Ritual::findOrFail($id);

        // Update the scalar fields
        $ritual->ritual_name = $request->ritual_name;
        $ritual->time = $request->time;
        $ritual->date = $request->date;
        $ritual->description = $request->description;
    
        // Update the multiple select fields
        $ritual->niti_name = implode(',', $request->input('niti_name', []));
        $ritual->sebak_name = implode(',', $request->input('sebak_name', []));

        if ($ritual->save()) {
          
            return redirect()->back()->with('success', 'Data updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update data.');
        } 
    }
    
    

}
