<?php

namespace App\Mail;

use App\Models\Reservation;
use Dompdf\Dompdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationApproved extends Mailable
{
    use Queueable, SerializesModels;

    protected $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function build()
    {
        return $this->subject('Reservation Approved')
            ->view('mail.reservation_approved', ['reservation' => $this->reservation])
            ->attachData($this->generatePdf(), 'ticket.pdf', ['mime' => 'application/pdf']);
    }

    private function generatePdf()
    {
        // Create a new Dompdf instance
        $dompdf = new Dompdf();

        // Load the HTML content for the PDF
        $html = view('event.ticket', ['ticket' => $this->reservation])->render();
        $dompdf->loadHtml($html);

        // Set paper size (optional)
        $dompdf->setPaper('A4');

        // Render the PDF (output)
        $dompdf->render();

        // Get the output as binary string
        $output = $dompdf->output();

        return $output;
    }
}
