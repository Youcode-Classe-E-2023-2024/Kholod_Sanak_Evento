<?php

namespace App\Http\Controllers;

use App\Mail\ReservationApproved;
use App\Mail\ReservationDeclined;
use App\Models\Event;
use App\Models\Reservation;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
            $eventStatus = $eventPlace->status;
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
        $ticket->user_id = $user_id;
        $ticket->event_id = $request->event_id;
        $ticket->ticket_number = rand(10000000, 99999999);
        $reservation->ticket()->save($ticket);

        // Check if the reservation is not approved, then send the email
        if ($eventStatus == 1) {
            Mail::to($validatedData['email'])->send(new ReservationApproved($reservation));
        }

        return redirect()->route('event.single', $reservation->event_id);
    }
//    public function store1(Request $request)
//    {
//        // Validate the request data
//        $validatedData = $request->validate([
//            'email' => 'required|email',
//        ]);
//
//        // Find the event place and decrement the nombre_place
//        $eventPlace = Event::find($request->event_id);
//        if ($eventPlace) {
//            $eventPlace->decrement('nombre_place');
//        }
//
//        $user_id = Auth::id();
//
//        // Create a reservation
//        $reservation = Reservation::create([
//            'user_id' => $user_id,
//            'event_id' => $request->event_id,
//            'email' => $validatedData['email'],
//        ]);
//
//        // Create a ticket and associate it with the reservation
//        $ticket = new Ticket();
//        $ticket->user_id=$user_id;
//        $ticket->event_id = $request->event_id;
//        $ticket->ticket_number = rand(10000000, 99999999);
//        $reservation->ticket()->save($ticket);
//
//
////        return redirect()->route('ticket.show', $ticket->id);
//        return redirect()->route('ticket.download', $ticket->id);
//
//    }

    /////////////////////////////////          Organizer             ///////////////////////////////////////////
    ///
    public function showReservationList(){

//        $reservations= Reservation::latest()->paginate(10);
        $reservations = Reservation::with('event')->where('status',0)
            ->whereHas('event', function ($query) {
                $query->where('status', 0);
            })
            ->latest()
            ->paginate(8);

        return view('writer.reservations',[
            'reservations'=>$reservations,
        ]);
    }


    public function approve($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 1;
        $reservation->save();

        Mail::to($reservation->email)->send(new ReservationApproved($reservation));

        return redirect()->back()->with('success', 'Reservation has been approved.');
    }

    public function decline($id)
    {
        $reservation = Reservation::findOrFail($id);

        $reservation->delete();
        Mail::to($reservation->email)->send(new ReservationDeclined($reservation));

        return redirect()->back()->with('success', 'Reservation has been declined.');
    }

}
