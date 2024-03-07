<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function showPaymentForm($eventId)
    {
        $event = Event::findOrFail($eventId);
        return view('event.ticketForm', compact('event'));
    }

    public function showTicket($ticketId)
    {
        $ticket = Ticket::findOrFail($ticketId);
        return view('event.ticket', compact('ticket'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);

        // Find the event place and decrement the nombre_place
        $eventPlace = Event::find($request->event_id);
        if ($eventPlace) {
            $eventPlace->decrement('nombre_place');
        }

        $user_id = Auth::id();

        // Create a reservation
        $reservation = Reservation::create([
            'user_id' => $user_id,
            'event_id' => $request->event_id,
            'email' => $validatedData['email'],
        ]);

        // Create a ticket and associate it with the reservation
        $ticket = new Ticket();
        $ticket->user_id=$user_id;
        $ticket->event_id = $request->event_id;
        $ticket->ticket_number = rand(10000000, 99999999);
        $reservation->ticket()->save($ticket);

//        return redirect()->route('ticket.show', $ticket->id);
        return redirect()->route('ticket.download', $ticket->id);

    }

}
