<?php

namespace App\Http\Controllers;

use App\Models\Medias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    public function index()
    {
        //dd(asset("storage/ctm.png"));
        return view('media.addMedia');
    }





//    public function store(Request $request)
//    {
//        $userId = Auth::id();
//        $media = Medias::create([
//            "user_id" => $userId
//        ]);
//
//        // Add the uploaded image to the media collection
//        $media->addMediaFromRequest('image')->toMediaCollection();
//
//        // Handle success scenario
//        return redirect()->back()->with('success', 'Image uploaded successfully.');
//    }


    // Upload Media
    public function upload(Request $request)
    {
        // Retrieve the logged-in user's ID
        $userId = Auth::id();

        // Create a new media instance and associate it with the user
        $media = Medias::create([
            "user_id" => $userId,

        ]);

        // Iterate over each uploaded file and add it to the media collection
        foreach ($request->file('files') as $file) {
            $storedFile = $file->store('uploads');

            // Add the stored file to the media collection
            $media->addMedia(storage_path('app/' . $storedFile))->toMediaCollection();
        }

        // Redirect back with success message
        return redirect()->route('media')->with('success', 'Files uploaded successfully.');
    }

    // Show Medias
    public function showMediaList1()
    {
        // Fetch and pass the list of media to the view
        $mediaList = Medias::all();

        // Iterate over each Medias instance to get the media name
        $mediaNames = $mediaList->map(function ($media) {
            return $media->getMediaName();
        });

        return view('writer.media', compact('mediaList', 'mediaNames'));
    }


    public function showMediaList()
    {
        $userId = Auth::id();

        // Retrieve all instances of Medias associated with the current user
        $userMedias = Medias::where('user_id', $userId)->get();

        // Create an empty array to store all media items
        $mediaList = [];

        // Loop through each instance of user's Medias
        foreach ($userMedias as $media) {
            // Get the media associated with the current instance
            $mediaItems = $media->getMedia();

            // Merge the media items into the $mediaList array
            $mediaList = array_merge($mediaList, $mediaItems->all());
        }

        // Now $mediaList contains all media items associated with all users

        // Pass $mediaList to the view for rendering
        return view('writer.media', compact('mediaList'));
    }






    // delete Media
    public function destroy($id)
    {
        // Find the media by its ID
        $media = Medias::find($id);

        if (!$media) {
            return redirect()->back()->with('error', 'Media not found.');
        }
        $media->delete();

        return redirect()->back()->with('success', 'Media deleted successfully.');
    }

    // Update Media
    public function update($id)
    {
        // Find the media by its ID
        $media = Medias::find($id);

        if (!$media) {
            return redirect()->back()->with('error', 'Media not found.');
        }

        return view('media.addMedia', compact('media'));
    }

}
