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
                        <th>Actions</th>
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
                        <td>
                        @hasanyrole('admin')
                            {{Form::open(array('route'=>array('notifications.destroy',$notification->id),'method'=>'DELETE','style'=>'display:inline;border:none;margin:0;padding:0;'))}}
                                {{csrf_field()}}
                                <button style="background:none!important;border:none;padding:0!important;border-bottom:1px solid #444; " title="Delete notifications">
                                    <i class="btn btn-danger fa fa-trash" aria-hidden="true"></i>
                                </button>
                            {{Form::close()}}
                        @endhasanyrole
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop