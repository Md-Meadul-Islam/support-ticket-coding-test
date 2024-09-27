<?php

namespace App\Http\Controllers;

use App\Events\StatusChange;
use App\Mail\TicketStatusUpdatedMail;
use App\Models\TicketResponse;
use App\Models\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index()
    {
        $tickets = Tickets::orderBy('id', 'DESC')
            ->with('user:id,name,email')
            ->with('response')
            ->get();
        // dd($tickets);
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
    public function changestatus(Request $request)
    {
        $ticket = Tickets::find($request->id);
        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket not found.',
            ], 404);
        }
        $ticket->status = 'closed';
        $ticket->updated_at = Carbon::now();
        $ticket->save();
        Mail::to($ticket->user->email)
            ->send(new TicketStatusUpdatedMail($ticket));
        return response()->json([
            'success' => true,
            'message' => 'Ticket status updated to closed.',
        ]);
    }
}
