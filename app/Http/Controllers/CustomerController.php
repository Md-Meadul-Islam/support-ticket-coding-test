<?php

namespace App\Http\Controllers;

use App\Events\Ticket;
use App\Mail\TicketCreated;
use App\Models\Tickets;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $tickets = Tickets::where('user_id', $userId)->with('response')->orderBy('id', 'DESC')->get();
        return view('customers.dashboard', compact('tickets'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'desc' => ['required', 'string', 'max:500'],
        ]);

        $ticket = Tickets::create([
            'user_id' => Auth::user()->id,
            'subject' => $request->subject,
            'desc' => $request->desc,
        ]);
        Mail::to('mdmeadulislam@gmail.com')->send(new TicketCreated($ticket));
        return redirect()->route('customer.dashboard');
    }
}
