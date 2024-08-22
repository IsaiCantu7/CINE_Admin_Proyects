<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Ticket;

class PDFController extends Controller
{
    public function downloadTicketReport($id)
    {
        // Obtén el ticket específico
        $venta = Ticket::findOrFail($id);

        // Carga la vista con los datos del ticket
        $pdf = Pdf::loadView('pdf.ticket_report', compact('venta'));

        // Descarga el PDF
        return $pdf->download('ticket_' . $id . '.pdf');
    }
}

