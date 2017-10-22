@extends('layout.app')
@section('content')
<div class="card mb-3">
    <div class="card-header">
        <a class="btn btn-primary pull-right" href="{{route('notifications.create')}}">Send new notification</a>
        <i class="fa fa-table"></i> Notifications </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Message</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Last Seen</th>
                        <th>Created at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notifications as $notification)
                    <tr>
                        <td>{{$notification->title}}</td>
                        <td>{{$notification->message}}</td>
                        <td>{{$notification->user->name}}</td>
                        <td>{{$notification->user->email}}</td>
                        <td>
                        @if($notification->last_seen)
                            {{$notification->last_seen->toFormattedDateString()}}
                        @else
                            Not yet seen
                        @endif
                        </td>
                        <td>{{$notification->created_at->toFormattedDateString()}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop