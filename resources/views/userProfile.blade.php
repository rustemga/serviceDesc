@extends('layouts.app')

@section('content')
    <div class="container">
        <div style="position: relative">
            <img src="{{$user->avatar}}" alt="avatar">

            <div style="
            width: 50px;
            height: 50px;
            background-color: #95c5ed;
            text-align: center;
            color: white;
            position: absolute;
            transform: translate(250%, -50%);">
                <p style="
                line-height: 50px;
                font-weight: bold;
                font-size: 38px;">
                    +
                </p>
            </div>
        </div>
        <p class="font-weight-bold">{{$user->name}}</p>
        <p>{{$user->role}}</p>
    </div>
@endsection
