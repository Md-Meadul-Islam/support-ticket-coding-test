<?php

namespace App\Mail;

use App\Models\Tickets;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class TicketCreated extends Mailable
{
    use Queueable, SerializesModels;
    public $ticket;
    public function __construct(Tickets $tickets)
    {
        $this->ticket = $tickets;
    }
    public function build()
    {
        return $this->from(config('mail.from.address'))
            ->markdown('emails.ticket_created')
            ->subject('New Ticket Created')
            ->with([
                'subject' => $this->ticket->subject,
                'desc' => $this->ticket->desc,
            ]);
    }
}
