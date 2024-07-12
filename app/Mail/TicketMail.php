<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public $name;
    public $email;
    public $whatsapp;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ticket, $name, $email, $whatsapp)
    {
        $this->ticket = $ticket;
        $this->name = $name;
        $this->email = $email;
        $this->whatsapp = $whatsapp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.ticket')
                    ->with([
                        'ticket' => $this->ticket,
                        'name' => $this->name,
                        'email' => $this->email,
                        'whatsapp' => $this->whatsapp,
                    ]);
    }
}
?>