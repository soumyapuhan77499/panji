<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;

class NoticeController extends Controller
{
    public function notice(){
        return view('notice');
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
}
