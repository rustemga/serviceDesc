<div class="col-md-3 py-3"  style="background-color: #1d68a754; border: 5px solid white;">

    <p class="font-weight-bold">Ticket #{{$ticket->id}}</p>
    <a href="{{route('profile', ['tag'=>$ticket->author->name])}}">
        <img style="width: 29%;" class="mb-3" src="{{$ticket->author->avatar}}" alt="avatar">
    </a>
    <a href="{{route('ticket',['tag'=>$ticket->id])}}"><h4>{{$ticket->subject}}</h4></a>
    <p>Owner: {{$ticket->author->name}}</p>
    <p>Status: {{$ticket->status}}</p>
</div>
