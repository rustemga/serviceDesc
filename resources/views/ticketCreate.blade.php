@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('message.messages')
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">New Ticket</div>

                    <div class="card-body">



                        <form method="POST" action="{{ route('addNewTicket') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="subject" class="col-md-4 col-form-label text-md-right">Subject</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="subject" value="{{ old('subject') }}" required autofocus>
                                    @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ticket_text" class="col-md-4 col-form-label text-md-right">Ticket</label>

                                <div class="col-md-6">
                                    <textarea class="form-control" name="ticket_text" value="{{ old('ticket_text') }}" required>
                                    </textarea>
                                    @error('ticket_text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
