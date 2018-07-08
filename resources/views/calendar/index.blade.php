@extends('layout.app')
@section('content')
<div class="card mb-3">
    <div class="card-header">
    <a class="btn btn-primary pull-right" href="{{route('calendar.create')}}">Create new event</a>
        <i class="fa fa-table"></i> Calendar</div>
        <div class="card-body">
        
            <div id='calendar'></div>
            

        </div>
    </div>
</div>
@stop

@section('script')
$(document).ready(function() {
    // page is now ready, initialize the calendar...
    $('#calendar').fullCalendar({
        // put your options and callbacks here
        events : [
            @foreach($tasks as $task)
            {
                title : '{{ $task->description ."-".$task->user->name }}',
                start : '{{ $task->started_at }}',
                end : '{{ $task->ended_at }}',
                //url : '{{ route('calendar.edit', $task->id) }}'
            },
            @endforeach
        ]
    });
    console.log($('#calendar'));
});
@endsection