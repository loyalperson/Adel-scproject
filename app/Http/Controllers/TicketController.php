<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketMail;
use App\Models\Ticket;
use Exception;

class TicketController extends Controller
{
    public function sendTicket(Request $request)
    {
        $request->validate([
            'ticket' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|string',
            'whatsapp' => 'required|string',
        ]);

        $ticket = $request->input('ticket');
        $name = $request->input('name');
        $email = $request->input('email');
        $whatsapp = $request->input('whatsapp');

        try {
            // Save ticket data to the database
            Ticket::create([
                'ticket' => $ticket,
                'name' => $name,
                'email' => $email,
                'whatsapp' => $whatsapp,
            ]);

            // Send email to support@example.com
            Mail::to('support@example.com')->send(new TicketMail($ticket, $name, $email, $whatsapp));

            // If the mail is sent successfully, return with success message
            return back()->with('success', 'Your ticket has been submitted!');
        } catch (Exception $e) {
            // If there is an error, log the exception and return with error message
            return back()->with('error', 'There was an error submitting your ticket. Please try again later.');
        }
    }
}
?>
