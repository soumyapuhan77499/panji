<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Youtube;

class YoutubeController extends Controller
{
    public function youtube(){
        return view('youtubeurl');
    }

    public function manageYoutube(){

        $youtubes = Youtube::where('status', 'active')->get();

        return view('manageyoutube',compact('youtubes'));

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

    public function editYouTube($id)
    {
        $youtube = YouTube::findOrFail($id);
        return view('updateyoutube', compact('youtube'));
    }

    public function updateYouTube(Request $request, $id)
    {
        $request->validate([
            'youtube_url' => 'required|url|max:255',
        ]);

        $youtube = YouTube::findOrFail($id);
        $youtube->youtube_url = $request->youtube_url;
        $youtube->save();

        return redirect()->route('manageYoutube')->with('success', 'YouTube URL updated successfully!');
    }

    public function deleteYouTube($id)
    {
        $youtube = YouTube::findOrFail($id);
        $youtube->status = 'deleted';
        $youtube->save();

        return redirect()->route('manageYoutube')->with('success', 'YouTube URL status updated to deleted successfully!');
    }
}
