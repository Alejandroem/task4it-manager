 <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-fw fa-envelope"></i>
    <span class="d-lg-none">Messages
        <span class="badge badge-pill badge-primary">
        
        {{Auth::user()->newnotifications}} New
        
        </span>
    </span>
    @if(Auth::user()->newnotifications>0)
    <span class="indicator text-primary d-none d-lg-block">
        <i class="fa fa-fw fa-circle"></i>
    </span>
    @endif
    </a>
    <div class="dropdown-menu" aria-labelledby="messagesDropdown">
    <h6 class="dropdown-header">New Messages:</h6>
    <div class="dropdown-divider"></div>
    @foreach(Auth::user()->notifications as $notification)
    <a class="dropdown-item" href="#">
        <strong>{{$notification->title}}</strong>
        <span class="small float-right text-muted">
        @if($notification->created_at->diff()->days < 1)
            {{$notification->created_at->format('h:i A')}}
        @else
            {{$notification->created_at->toDateString()}}
        @endif
        </span>
        <div class="dropdown-message small">{{$notification->message}}</div>
    </a>
    @endforeach

</li>