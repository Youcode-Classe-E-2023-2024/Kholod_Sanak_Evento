<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailList;

use PDF;


class PdfController extends Controller
{
    public function generatePdf()
    {
        $subscribers = EmailList::all();
        $pdf = PDF::loadView('writer.subsTable', compact('subscribers'));
        return $pdf->download('subscribers.pdf');
    }
}
