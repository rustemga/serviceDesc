<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditTicketRequest;
use App\Http\Requests\TicketRequest;
use App\Mail\NewTicket;
use App\Tickets;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tickets $tickets)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return $this->authCheck('/ticketCreate');
//        if(Auth::check()){
//            return view('/ticketCreate');
//        }else{
//            return view('/welcome');
//        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EditTicketRequest $request)
    {

//        $request->validate([
//            'subject' => 'required',
//            'ticket_text' => 'required',
//        ]);

        $ticket = new Tickets();
        $ticket->subject = $request->subject;
        $ticket->ticket_text = $request->ticket_text;
        $ticket->user_id = Auth::user()->id;
        $ticket->status = 'open';
        $ticket->save();

        $admin = new User();
        $admin->where('role', 'admin')->get();

        Mail::to(auth()->user()->email)->send(new NewTicket($request->subject, $request->ticket_text, Auth::user()->name));
        foreach ($admin->where('role', 'admin')->get() as $user) {
            Mail::to($user->email)->send(new NewTicket($request->subject, $request->ticket_text, Auth::user()->name));
        }


        return redirect(route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Tickets $tickets
     * @return \Illuminate\Http\Response
     */
    public function show(Tickets $ticket)
    {
        if(Auth::check()){
            return view('ticket', ['ticket' => $ticket]);
        }else{
            return redirect('/login');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Tickets $tickets
     * @return \Illuminate\Http\Response
     */
    public function edit(Tickets $ticket)
    {
        /**
         * проверка в файле UserPolicy
         */
        $this->authorize('ticketEdit', $ticket->author);
        return view('editTicket', ['tickets' => $ticket]);


//        $user = Auth::user();
//        //return view('editTicket', ['ticket' => $ticket]);
//        $auth = Auth::check();
////        if($auth && $user->role == 'admin' || $auth && $ticket->user_id == $user->id){
//        if($auth && $user->role == 'admin' || $auth && $ticket->author->is($user)){
//            $result = view('editTicket', ['tickets' => $ticket]);
//        }else{
//            $result = redirect('/home')->with('succes','You can`t edit whis ticket.');
//        }
//        return $result;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TicketRequest $request
     * @param Tickets $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(TicketRequest $request, Tickets $ticket)
    {
        /**
         * Выполнит действие только если данный ticket принадлежит этому user или user->role == admin
         **/
//        $auth = Auth::check();
//        $user = Auth::user();
//        if($auth && $user->role == 'admin' || $auth && $ticket->user_id == $user->id){
//            $ticket->subject = $request->input('subject');
//            $ticket->ticket_text = $request->input('ticket_text');
//            $ticket->status = $request->input('status');
//            $ticket->save();
//
//            return redirect($ticket->path());
//        }else{
//            return redirect('/login');;
//        }
        /**
         * Выполнит действие только если данный ticket принадлежит этому user
         **/
//        $this->authorize('delete-ticket-button', $ticket );
//
//        $ticket->subject = $request->input('subject');
//        $ticket->ticket_text = $request->input('ticket_text');
//        $ticket->status = $request->input('status');
//        $ticket->save();

        /**
         * Проверка осуществляется при помощи файла TicketPolicy
         */
        $this->authorize('update', $ticket );

        $ticket->subject = $request->input('subject');
        $ticket->ticket_text = $request->input('ticket_text');
        $ticket->status = $request->input('status');
        $ticket->save();
        return redirect($ticket->path());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Tickets $tickets
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tickets $ticket)
    {   $auth = Auth::check();
        $user = Auth::user();
       if($auth && $user->role == 'admin' || $auth && $ticket->user_id == $user->id){
           $ticket -> delete();
       }
        return redirect('home');
    }

    protected function authCheck($view, $param = null){
        if(Auth::check()){
            if($param != null){
                $result = view($view,[$param]);
            }else{
                $result = view($view);
            }

        }else{
            $result = redirect('/login');
        }
        return $result;
    }
}
