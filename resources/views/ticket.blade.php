@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('message.messages')
            </div>
        </div>
        <a href="{{route('home')}}"><-Home</a>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Ticket</div>

                    <div class="card-body">
                        <div class="container">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5><b>Ticket #{{$ticket->id}}</b></h5>
                                            <h4>{{$ticket->subject}}</h4>
                                            <p>{{$ticket->ticket_text}}</p>
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5><b>Comments</b></h5>
                                        @foreach($ticket->replies as $reply)
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p><b>{{$reply->reply_text}}</b></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <img src="{{$reply->author->avatar}}" alt="avatar">
                                                </div>
                                                <div class="col-md-3">
                                                    <p>{{$reply->author->name}}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>{{$reply->created_at}}</p>
                                                </div>
                                                <div class="col-md-4">
                                                    @can('delete', $reply)
                                                        <form action="{{route('removeReply',['tag'=>$reply->id])}}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary">
                                                                Remove reply
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </div>

                                            </div>
                                            <hr>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5><b>Status</b></h5>
                                        <p>{{$ticket->status}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5><b>Aded by</b></h5>
                                        <a href="{{route('profile', ['tag'=>$ticket->author->name])}}">
                                            <img src="{{$ticket->author->avatar}}" alt="avatar">
                                            <p>{{$ticket->author->name}}</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5><b>Date</b></h5>
                                        <p>{{$ticket->created_at}}</p>
                                    </div>
                                </div>
                        <hr>
                        </div>
                    </div>
{{--                    @can('delete-ticket-button', $ticket)--}}
                    @can('update', $ticket)
                    <div class="card-header" style="margin-top: 50px;">Edit this ticket</div>
                    <div class="card-body">
                        <div class="form-group row mb-0">
                            <div class="col-md-1">
                                <a href="{{route('editTicket',['tag'=>$ticket->id])}}">
                                    <button class="btn btn-primary">
                                        Edit
                                    </button>
                                </a>
                            </div>

                            <div class="col-md-11">
                                <a href="{{route('deleteTicket',['tag'=>$ticket->id])}}">
                                    <button class="btn btn-primary">
                                        Delete
                                    </button>
                                </a>
                            </div>

                        </div>
                    </div>
                    @endcan
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

                    <div class="card-header" style="margin-top: 50px;">Add Reply</div>
                    <div class="card-body">
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <form action="{{ route('replyToTicket',['tag'=>$ticket->id]) }}" method="POST">
                                    @csrf
                                    <textarea name="reply_text" style="width: 50%;"></textarea>
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
