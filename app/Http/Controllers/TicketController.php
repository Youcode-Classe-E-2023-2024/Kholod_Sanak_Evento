<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use PDF;

//use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function download(Ticket $ticket)
    {
        $pdf = PDF::loadView('event.ticket', compact('ticket'));
        return $pdf->download('ticket.pdf');
    }

}
