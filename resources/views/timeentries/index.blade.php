@extends('layout.app')
@section('content')
<div class="card mb-3">
    <div class="card-header">
    <a class="btn btn-primary pull-right" href="{{route('timetracking.create')}}">Create new time entry</a>
        <i class="fa fa-table"></i> Time Entry </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Project</th>
                            <th>User</th>
                            <th>Started</th>
                            <th>Ended</th>
                            <th>Hours</th>
                            <th>Rate</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <hbody>
                    @foreach($timeentries as $timeentry)
                        <tr>
                            <td>
                                {{$timeentry->project->name}}
                            </td>
                            <td>
                                {{$timeentry->user->name}}
                            </td>
                            <td>
                                {{$timeentry->started_at->toDateTimeString()}}
                            </td>
                            <td>
                                {{$timeentry->ended_at->toDateTimeString()}}
                            </td>
                            <td>
                                {{$timeentry->ended_at->diffInHours($timeentry->started_at)}}
                            </td>
                            <td>
                                {{number_format($timeentry->hourly_rate,2)}} €
                            </td>
                            <td>
                                {{number_format($timeentry->ended_at->diffInHours($timeentry->started_at)*$timeentry->hourly_rate,2)}} €
                            </td>
                        </tr>
                    @endforeach 
                    </hbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop