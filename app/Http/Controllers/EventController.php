<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Lieu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Termwind\Components\Li;

class EventController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    |                                Organizer
    |--------------------------------------------------------------------------
    */


    public function index()
    {
        // Retrieve the currently authenticated organizer
        $organizer = Auth::user(); // Assuming your Organizer model is associated with the User model

        // Retrieve events associated with the organizer
        $events = $organizer->events()->withTrashed()->latest()->paginate(10);

        return view('writer.events', ['events' => $events]);
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


    public function showEventFormUpdate($id)
    {
        // Find the event by its ID
        $event = Event::findOrFail($id);

        // Fetch all categories and cities
        $categories = Category::all();
        $cities = Lieu::all();

        // Pass the event, categories, and cities to the view
        return view('writer.updateevent', compact('event', 'categories', 'cities'));
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


    public function update(Request $request, Event $event)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'title' => 'required|string',
            'category' => 'required|exists:categories,id',
            'lieu' => 'required|exists:lieu,id',
            'price' => 'required|numeric',
            'place' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'nullable|image', // Allow empty image field for not updating the image
            'deadline' => 'required|date',
            'reservation_type' => 'required|in:automatic,manual'
        ]);

        // Check if the authenticated user is the creator of the event
        if (Auth::id() !== $event->created_by) {
            return redirect()->back()->with('error', 'You are not authorized to update this event.');
        }

        // Update event data
        $event->titre = $validatedData['title'];
        $event->description = $validatedData['description'];
        $event->prix = $validatedData['price'];
        $event->nombre_place = $validatedData['place'];
        $event->ville_id = $validatedData['lieu'];
        $event->deadline = Carbon::parse($validatedData['deadline'])->toDateString();
        $event->category_id = $validatedData['category'];

        // Update reservation type and status
        $event->status = $validatedData['reservation_type'] === 'automatic' ? 1 : 0;

        // Update image if provided
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $media = $event->addMedia($file)->toMediaCollection();
            $event->id_image = $media->id;
        }

        // Save the updated event
        $event->save();

        // Redirect or return a response
        return redirect()->route('events.organizer')->with('success', 'Event updated successfully.');
    }





    /*
    |--------------------------------------------------------------------------
    |                                Admin
    |--------------------------------------------------------------------------
    */
    public function aprroveEvent(){
        $events = Event::where('acceptation', 0)->latest()->paginate(10);

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


    /*
    |--------------------------------------------------------------------------
    |                                User
    |--------------------------------------------------------------------------
    */

    public function affiche()
    {
        $events = Event::where('acceptation', 1)->latest()->paginate(10);
        $categories = Category::all();
        $cities = Lieu::all();

        return view("welcome", compact('events', 'categories', 'cities'));
    }


    public function show($id)
    {
        $event = Event::find($id);

        return view('event.single', compact('event'));
    }

    public function showEventByCategory($categoryId)
    {
        // Find the category by ID
        $category = Category::findOrFail($categoryId);

        // Retrieve events belonging to the specified category
        $events = Event::where('category_id', $categoryId)
            ->latest()
            ->paginate(2);

        return view('event.eventList', compact('category', 'events'));
    }

    public function showEventByCity($cityId)
    {
        // Find the city by ID
        $city = Lieu::findOrFail($cityId);

        // Retrieve events belonging to the specified city
        $events = Event::where('ville_id', $cityId)
            ->latest()
            ->paginate(2);

        return view('event.eventList', compact('city', 'events'));
    }

    public function searchEvents(Request $request)
    {
        $titre = $request->input('titre');

        $query = Event::query();

        if ($titre) {
            $query->where('titre', 'like', '%' . $titre . '%');
        }

        // Retrieve events based on the applied title filter
        $events = $query->latest()->paginate(10);

        return view('event.eventList', compact('events'));
    }


}
