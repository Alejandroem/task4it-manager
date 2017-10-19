<li class="nav-item">
    <div class="useravatar">
    <a href="{{route('users.show',['user'=>Auth::user()])}}">

        <img id="avatar" src="@if(Auth::user()->files->count()>0 && AUth::user()->files()->where('relation','avatar')->count()>0)
                                    {{URL::to(Auth::user()->files()->where('relation','avatar')->first()->public_resource_url)}}
                                @else 
                                    {{asset('img/avatar-default.png')}} 
                                @endif" alt="">
    </a>
    
        <span class="px-3 text-secondary">
            Welcome!! {{Auth::user()->name}}
        </span>
    </div>
</li>