<?php

namespace App\Http\Controllers;

use App\Models\TicketResponse;
use App\Models\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $tickets = Tickets::orderBy('id', 'DESC')->with('user:id,name,email')->get();
        return view('admin.dashboard', compact('tickets'));
    }
    public function createResponse(Request $request)
    {
        $ticket = Tickets::where('id', $request->id)->first();
        return view('admin.createresponse', compact('ticket'));
    }
    public function storeResponse(Request $request)
    {
        header('Content-type: application/json');
        $request->validate([
            'response' => ['required', 'string', 'max:500'],
        ]);
        $ticket = TicketResponse::create([
            'ticket_id' => $request->id,
            'admin_id' => Auth::user()->id,
            'response_text' => $request->response,
        ]);
        echo json_encode(['success' => true, 'message' => 'Response added successfully !']);
    }
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
