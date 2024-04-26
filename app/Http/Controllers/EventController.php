<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function manageevent(){
        $manageevents = Event::where('status', 'active')->get();
        return view('manageevent',compact('manageevents'));
    }
    public function addevent(){
        return view('addevent');
    }
    public function editDate($event_id)
    {
        $event = Event::where('event_id', $event_id)->first();

        return view('updateevent', compact('event'));
    }
    public function saveEvent(Request $request){
    
      $request->validate([
           'event_name' => 'required|string|max:255',
           'tithi' => 'required',
           'language'=>'required',
           'good_time' => 'required',
           'bad_time' => 'required',
           'sun_rise' => 'required',
           'sun_set' => 'required',
           'event_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:3072',
        ]);

        $event = new Event();

        if($request->hasFile('event_photo')){

            $path = 'assets/uploads/event_photo/'.$event->event_photo;
           
           
            $file = $request->file('event_photo');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/event_photo/',$filename);
            $event->event_photo=$filename;
          }

        // Assign form input values to the Event model properties
        $event->language = $request->language;
        $event->event_id = $request->event_id;
        $event->date = $request->date;
        $event->event_name = $request->event_name;
        $event->tithi = $request->tithi;
        $event->good_time = $request->good_time;
        $event->bad_time = $request->bad_time;
        $event->sun_rise = $request->sun_rise;
        $event->sun_set = $request->sun_set;
        $event->special_niti = $request->special_niti;

        if ($event->save()) {
            return redirect()->back()->with('success', 'Data saved successfully.');
        } else {
            return redirect()->back()->withErrors(['danger' => 'Failed to save data.']);
        }

    }
    public function index()
{
    $events = Event::all(); // Retrieve all events from the database
    return view('manageevent', ['events' => $events]);
}
public function viewevent($event_id){
    
    $eventinfo = Event::where('event_id', $event_id)->first();
  
    return view('viewevent',compact('eventinfo'));

}

public function updateStatus($event_Id)
{
        $affected = Event::where('event_id', $event_Id)
                        ->update(['status' => 'deleted']);

        if ($affected) {
            return redirect()->back()->with('success', 'Data delete successfully.');
        } else {
            return redirect()->back()->with('danger', 'Data delete unsuccessfully.');
        }
  
    }
    public function update(Request $request, $id)
    {
     
        // Find the event
        $event = Event::findOrFail($id);
        if($request->hasFile('event_photo')){

            $path = 'assets/uploads/event_photo/'.$event->event_photo;
           
           
            $file = $request->file('event_photo');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/event_photo/',$filename);
            $event->event_photo=$filename;
          }
     
        // Assign form input values to the Event model properties
        $event->event_id = $request->event_id;
        $event->language = $request->language;
        $event->date = $request->date;
        $event->event_name = $request->event_name;
        $event->tithi = $request->tithi;
        $event->good_time = $request->good_time;
        $event->bad_time = $request->bad_time;
        $event->sun_rise = $request->sun_rise;
        $event->sun_set = $request->sun_set;
        $event->special_niti = $request->special_niti;

        if ($event->update()) {
             return redirect()->back()->with('success', 'Data updated successfully.');
    } else {
             return redirect()->back()->with('error', 'Failed to update event.');
    }

       }

}

