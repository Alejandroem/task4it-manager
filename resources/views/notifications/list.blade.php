@extends('layout.app')
@section('content')
<div class="card mb-3">
    <div class="card-header">
        Notifications 
    </div>
    <div class="card-body">
        @foreach($notifications as $notification)
        <a class="dropdown-item p-0" href="{{$notification->url}}">
            <div class="alert {{$notification->type}}">
                <strong>{{$notification->title}}</strong>
                <span class="small float-right text-muted">
                @if($notification->created_at->diff(\Carbon\Carbon::now())->days < 1)
                    {{$notification->created_at->format('h:i A')}}
                @else
                    {{$notification->created_at->toDateString()}}
                @endif
                </span>
                @if($notification->message==="1")
                    <div class="dropdown-message small">Go to {{$notification->asset}}</div>
                @else
                    <div class="dropdown-message small">{{$notification->message}}</div>
                @endif
            </div>
        </a>
        <div class="dropdown-divider"></div>
        @endforeach
    </div>
</div>
@stop