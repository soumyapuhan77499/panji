<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;

class NoticeController extends Controller
{
    public function notice(){
        return view('notice');
    }

    public function manageNotice(){

        $notices = Notice::where('status', 'active')->get();

        return view('managenotice', compact('notices'));

    }

    public function saveNotice(Request $request)
    {
        // Validate the request
        $request->validate([
            'notice' => 'required|string|max:255',
        ]);

        // Create a new Notice
        $notice = new Notice();
        $notice->notice = $request->notice;
        $notice->save();

        // Redirect back or to a success page
        return redirect()->back()->with('success', 'Notice saved successfully!');
    }

    public function editNotice($id)
    {
        $notice = Notice::findOrFail($id);
        return view('updatenotice', compact('notice'));
    }

    public function updateNotice(Request $request, $id)
    {
        $request->validate([
            'notice' => 'required|string|max:255',
        ]);

        $notice = Notice::findOrFail($id);
        $notice->notice = $request->notice;
        $notice->save();

        return redirect()->route('managenotice')->with('success', 'Notice updated successfully!');
    }

   public function deleteNotice($id)
{
    $notice = Notice::findOrFail($id);
    $notice->status = 'deleted';
    $notice->save();

    return redirect()->route('managenotice')->with('success', 'Notice status updated to deleted successfully!');
}

}
