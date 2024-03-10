<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Reservation;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmailList;
use App\Models\Medias;
use App\Models\Newsletter;


use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Récupérer tous les utilisateurs avec leurs rôles
        $users = User::with('roles')->get();

        // Récupérer tous les rôles disponibles
        $allRoles = Role::all();

        // Passer les utilisateurs et les rôles récupérés à la vue
        return view('admin.users', compact('users', 'allRoles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // Update the user's role based on the request data
        $user->syncRoles([$request->role]);

        // Redirect back or wherever you want
        return redirect()->back()->with('success', 'User role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId)
    {
        $user = User::findOrFail($userId);

        if ($user->trashed()) {
            $user->restore();
            return redirect()->back()->with('success', 'User restored successfully');
        } else {
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully');
        }
    }


    public function trashed()
    {
        $trashedUsers = User::onlyTrashed()->get();
        return view('admin.restoredUsers', compact('trashedUsers'));
    }

    public function restore($userId)
    {
        $user = User::onlyTrashed()->findOrFail($userId);
        $user->restore();

        return redirect('usersList');
    }





    ///////////////////////////               admin dashboard view
    ///
    ///
    public function adminDashboard()
    {
        // Retrieve the user count with the 'editor' role
        $userCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'organizer');
        })->count();

        $userCount1 = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->count();

       // Count pending events (status = 0)
        $pendingEvents = Event::where('acceptation', 0)->count();

         // Count approved events (acceptation = 1)
        $approvedEvents = Event::where('acceptation', 1)->count();

        $categories= Category::all()->count();
        $tickets= Ticket::all()->count();

        //organizer created how many events (both published and pending)
        $eventsByOrganizers = User::role('organizer')->withCount('events')->get();

        return view('admin.dashboard', compact('userCount', 'userCount1','pendingEvents',
            'approvedEvents','categories','tickets','eventsByOrganizers'));
    }

    ///////////////////////////            Organizer dashboard view
    ///

    public function editorDashboard(){

        $user = Auth::user();

        if ($user) {
            // Count pending events for the user (status = 0)
            $pendingEvents = $user->events()->where('acceptation', 0)->count();

            // Count approved events for the user (acceptation = 1)
            $approvedEvents = $user->events()->where('acceptation', 1)->count();
        } else {
            $pendingEvents = 0;
            $approvedEvents = 0;
        }

        $soldOutEvents = auth()->user()->events()
            ->where('acceptation', 1)
            ->where('nombre_place', 0)
            ->count();

        // Get the event with the highest number of reservations for the authenticated user
        $topEvent = auth()->user()->events()
            ->select('events.*')
            ->selectSub(
                Reservation::selectRaw('count(*)')
                    ->whereColumn('event_id', 'events.id'),
                'reservations_count'
            )
            ->orderByDesc('reservations_count')
            ->first();

        // Access the count of reservations for the top event
        $reservationCount = optional($topEvent)->reservations_count ?? 0;


        //the number of generated tickets for each event
        $user = Auth::user();
        $events = $user->events;

        $ticketData = [];

        foreach ($events as $event) {
            $ticketData[] = [
                'event_name' => $event->titre,
                'ticket_count' => Ticket::where('event_id', $event->id)->count(),
            ];
        }

        return view('writer.dashboard',compact('ticketData','pendingEvents','approvedEvents','soldOutEvents','reservationCount'));
    }


}
