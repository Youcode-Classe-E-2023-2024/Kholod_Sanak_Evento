<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Lieu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::withTrashed()->latest()->paginate(10);

        return view('writer.events', ['events' => $events]);
    }

    public function stat(){
        $events = Event::all()->count();
    }



    public function showEventForm()
    {
        $categories = Category::all();
        $cities= Lieu ::all();

        return view('writer.templateForm', [
            'categories' => $categories,
            'cities' => $cities
        ]);
    }

    public function store(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'title' => 'required|string',
            'category' => 'required|exists:categories,id',
            'lieu' => 'required|exists:lieu,id',
            'price' => 'required|numeric',
            'place' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'required|image', // Assuming 'image' is an uploaded image file
            'deadline' => 'required|date',
            'reservation_type' => 'required|in:automatic,manual'
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Create a new Event instance
        $event = Event::create([
            'titre' => $validatedData['title'],
            'description' => $validatedData['description'],
            'created_by' => $user->id,
            'prix' => $validatedData['price'],
            'nombre_place' => $validatedData['place'],
            'ville_id' => $validatedData['lieu'],
            'deadline' => Carbon::parse($validatedData['deadline'])->toDateString(),
            'category_id' => $validatedData['category'],
        ]);

        // Store the uploaded image using Spatie Media Library
        $file = $request->file('image');
        $media = $event->addMedia($file)->toMediaCollection();

        // Set the media ID in the id_image column
        $event->id_image = $media->id;

        // Set status based on reservation type
        $event->status = $validatedData['reservation_type'] === 'automatic' ? 1 : 0;

        // Save the event to the database
        $event->save();

        // Redirect or return a response
        return redirect()->route('events.organizer')->with('success', 'Event created successfully.');
    }


    public function destroyOrganizer(Event $event)
   {
        if (Auth::id() !== $event->created_by) {
            return redirect()->back()->with('error', 'You are not authorized to delete this event.');
        }

        $event->delete();

        return redirect()->route('events.organizer')->with('success', 'Event deleted successfully.');
   }


    /////////////////////////////           Admin             ////////////////////////////
    public function aprroveEvent(){
        $events = Event::latest()->paginate(10);

        return view('admin.events',[
            'events'=>$events
        ]);
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->back()->with('success', 'Event declined successfully.');
    }

    public function approve(Request $request, Event $event)
    {
        $event->update(['acceptation' => 1]);
        return redirect()->back()->with('success', 'Event approved successfully.');
    }
}
