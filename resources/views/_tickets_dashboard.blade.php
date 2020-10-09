<div class="row" style="{{$loop->last ? '' : 'border-bottom-style: inset;'}} background-color: @if($ticket->status == 'open')#fff0f0 @else #eaffe8 @endif">
    <div class="col-md-5">
        <h5><b>Ticket #{{$ticket->id}}</b></h5>
        <a href="{{route('ticket',['tag'=>$ticket->id])}}"><h4>{{$ticket->subject}}</h4></a>
        {{--<p>{{$ticket->ticket_text}}</p>--}}
    </div>

    <div class="col-md-2">
        <h5><b>Autor</b></h5>
        <p>{{$ticket->user->name}}</p>
    </div>
    <div class="col-md-1">
        <img style="width: 40px" src="{{$ticket->author->avatar}}" alt="avatar">
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
{{$loop->last ? '' : '<hr>'}}
