@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('message.messages')
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit ticket</div>
                    <div class="card-body">
{{--                    @can('update', $tickets)--}}
                        @can('ticketEdit', $tickets->author)
                        <form method="POST" action="{{ route('updateTicket',['tag'=>$tickets->id]) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <h5><b>Ticket #{{$tickets->id}}</b></h5>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="subject" class="col-md-2 col-form-label text-md-right">Subject</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="subject" value="{{$tickets->subject}}" required autofocus>
                                    @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ticket_text" class="col-md-2 col-form-label text-md-right">Ticket</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" name="ticket_text" required>{{$tickets->ticket_text}}</textarea>
                                    @error('ticket_text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-md-2 col-form-label text-md-right">Status</label>
                                <div class="col-md-10">
                                    <select type="radio" class="form-control" name="status" required>
                                        <option value="open">open</option>
                                        <option value="close">close</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row offset-md-11">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        Edit
                                    </button>
                                </div>
                            </div>
                        </form>
                        @endcan
                        @error('subject') subject @enderror
                        @error('ticket_text') ticket_text @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
