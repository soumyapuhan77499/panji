<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Youtube;

class YoutubeController extends Controller
{
    public function youtube(){
        return view('youtubeurl');
    }

    public function saveYoutubeUrl(Request $request)
    {
        // Validate the request
        $request->validate([
            'youtube_url' => 'required',
        ]);

        // Create a new Youtube record
        $youtube = new Youtube();
        $youtube->youtube_url = $request->youtube_url;
        $youtube->save();

        // Redirect back or to a success page
        return redirect()->back()->with('success', 'YouTube URL saved successfully!');
    }
}
