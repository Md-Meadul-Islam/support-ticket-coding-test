<?php

namespace App\Listeners;

use App\Events\Ticket;
use App\Mail\TicketCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendTicketToAdmin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Ticket $event): void
    {
        Mail::to('mdmeadulislam@gmail.com')->send(new TicketCreated($event->ticket));
    }
}
