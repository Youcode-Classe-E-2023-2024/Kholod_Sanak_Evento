<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Support\Facades\Storage;
use PDF;

//use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function download(Ticket $ticket)
    {
        // Generate PDF
        $pdf = PDF::loadView('event.ticket', compact('ticket'));

        // Store PDF in storage
        $pdfPath = 'pdfs/ticket_' . $ticket->id . '.pdf'; // Adjust the path as needed
        Storage::put($pdfPath, $pdf->output());

        // Return download response
        return $pdf->download('ticket.pdf');
    }

}
