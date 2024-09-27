<?php

namespace App\Mail;

use App\Models\Tickets;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketStatusUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    public function __construct(Tickets $tickets)
    {
        $this->ticket = $tickets;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ticket Status Updated Mail',
        );
    }

    public function build()
    {
        return $this->from(config('mail.from.address'))
            ->subject('Your Ticket Status has been Updated')
            ->view('emails.ticket_status_updated')
            ->with([
                'ticket' => $this->ticket,
            ]);
    }
}
