<li class="list-group-item">
    <p><a href="{{route('profile', ['tag'=>$userf->name])}}">{{$userf->name}}</a> {{$userf->role}}</p>
    <ul class="list-group">
        @foreach($userf->tickets()->paginate(5) as $ticket)
            <li>#{{$ticket->id}} {{$ticket->subject}}
                <p>{{$ticket->created_at}}</p>
            </li>
        @endforeach
    </ul>
</li>

