<div class="col-md-2 py-2 mr-1 bg-light border mx-auto">
{{--    <img src="{{$user->avatar}}" alt="avatar">--}}

{{--        <a href="{{route('profile', ['tag'=>$user->name])}}">--}}
{{--            <img src="{{$user->avatar}}" alt="avatar">--}}
{{--            <p class="font-weight-bold">{{$user->name}}</p>--}}
{{--        </a>--}}
{{--    Другая реализация ссылки как выше при помощи метода path()--}}
        <a href="{{$user->path()}}">
            <img style="width: 40px" src="{{$user->avatar}}" alt="avatar">
            <p class="font-weight-bold">{{$user->name}}</p>
        </a>
        <p>{{$user->role}}</p>
        <a href="{{route('follow', ['tag'=> $user])}}"><button type="button" class="btn btn-success">
               {{current_user()->following($user)? 'Unfollow' : 'Follow'}}
            </button></a>

</div>
