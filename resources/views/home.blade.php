@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('message.messages')
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-2">
                <div class="card-header">You Follows</div>
                <ul class="list-group">
                    @forelse($user->follows as $userf)
                        @include('followers')
                    @empty
                        No followers!
                    @endforelse
                </ul>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Dashboard</div>
                    <a href="{{route('createTable')}}"><button class="btn btn-primary">Create Table</button></a>

                    <div class="card-body">
                        <div class="container">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @forelse($tickets as $ticket)
{{--                            @if($ticket->user_id == $user->id)--}}
                                @if($ticket->isOwnTicket())
                                    <div class="row"
                                         style="background-color: @if($ticket->status == 'open')#fff0f0 @else #eaffe8 @endif">
                                        <div class="col-md-5">
                                            <h5><b>Ticket #{{$ticket->id}}</b></h5>
                                            <a href="{{route('ticket',['tag'=>$ticket->id])}}">
                                                <h4>{{$ticket->subject}}</h4></a>
                                            {{--                                <p>{{$ticket->ticket_text}}</p>--}}
                                        </div>
                                        <div class="col-md-2" style="text-align: center;">
                                            <h5><b>Comment</b></h5>
                                            <p>{{$ticket->replies->count()}}</p>
                                        </div>
                                        <div class="col-md-1">
                                            {{--                                <img src="{{$ticket->author->avatar}}" alt="avatar">--}}
                                        </div>
                                        <div class="col-md-2">
                                            <h5><b>Date</b></h5>
                                            <p>{{$ticket->created_at}}</p>
                                        </div>
                                        <div class="col-md-2">
                                            <h5><b>Status</b></h5>
                                            <p>{{$ticket->status}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                @endif
                                @empty

                                        Where no tickets!

                            @endforelse
                            {{$tickets->links()}}
                        </div>
                    </div>

                    <div class="card-header" style="margin-top: 50px;">Create ticket</div>
                    <div class="card-body">
                        <div class="form-group row mb-0">
                            <div class="col-md-8">
                                <a href="{{route('createTicket')}}">
                                    <button class="btn btn-primary">
                                        New ticket
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group row mb-0">
                            @foreach($tickets as $ticket)
                                @include('_all_tickets')
                            @endforeach
                        </div>
                    </div>
                    <div class="card-header" style="margin-top: 50px;">All users</div>
                    <div class="card-body">
                        <div class="form-group row mb-0">
                            @foreach($allUsers as $user )
                                {{--                        @if($user->name != auth()->user()->name)--}}
                                {{--                            @if(auth()->user()->isNot($user))--}}
                                @if(current_user()->isNot($user))
                                    @include('all_users')
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card-header">Followers Tickets</div>
                <ul class="list-group">
                    @foreach(auth()->user()->follows as $userf)
                        @include('followersTickets')
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
