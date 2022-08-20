<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    //show all tickets for a user
    public function index()
    {
        $tickets = Ticket::where('user_id', auth()->id())->get();
        return view('tickets.index', compact('tickets'));
    }

    //show the form to create a new ticket
    public function create()
    {
        return view('tickets.create');
    }

    //store a new ticket
    public function store()
    {
        $this->validate(request(), [
            'title' => 'required',
            'content' => 'required'
        ]);

        $ticket = new Ticket;
        $ticket->title = request('title');
        $ticket->content = request('content');
        $ticket->user_id = auth()->id();
        $ticket->save();

        return redirect('/tickets');
    }   

    //show a single Ticket
    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    
}
