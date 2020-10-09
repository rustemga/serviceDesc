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
                    @foreach($user->follows as $userf)
                        @include('followers')
                    @endforeach
                </ul>
            </div>
            <div class="col-md-7">
                @include('inc.messages')
                <div class="card">
                    <div class="card-header">Administrator Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <p>You are logged in as Administrator!</p>
                            <a href="{{route('CreateByAdmin')}}"><button class="btn btn-primary">Register new user</button></a>
                            <a href="{{route('createTable')}}"><button class="btn btn-primary">Create Table</button></a>
                    </div>

                    <div class="card-header">All tickets</div>

                    <div class="card-body">
                        <div class="container">
                        @foreach($tickets as $ticket)
                            @include('_tickets_dashboard')
                        @endforeach
                            {{$tickets->links()}}
                        </div>
                    </div>

                    <div class="card-header">Add new department</div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('departmentCreate') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="department" class="col-md-4 col-form-label text-md-right">Enter name of department:</label>

                                <div class="col-md-6">
                                    <input class="form-control" name="department"  required autofocus>

                                    @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-header" style="margin-top: 50px;">All users</div>
                    <div class="card-body">
                        <div class="form-group row mb-0">
                            @foreach($allUsers as $user )
                                @if($user->name != auth()->user()->name)
                                    @include('all_users')
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 px-3">
                <div class="card-header">Followers Tickets</div>
                <ul class="list-group">
                    @foreach(current_user()->follows as $userf)
                        @include('followersTickets')
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
