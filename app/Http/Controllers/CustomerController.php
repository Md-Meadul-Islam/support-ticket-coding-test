<?php

namespace App\Http\Controllers;

use App\Events\Ticket;
use App\Models\Tickets;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $tickets = Tickets::where('user_id', $userId)->get();
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
        event(new Ticket($ticket));
        return redirect()->route('customer.dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
