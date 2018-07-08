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
                            <th>Hours</th>
                            <th>Rate</th>
                            <th>Total</th>
                            <th></th>
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
                                {{$timeentry->hours }} H
                            </td>
                            <td>
                                {{number_format($timeentry->hourly_rate,2)}} €
                            </td>
                            <td>
                                {{number_format($timeentry->hours*$timeentry->hourly_rate,2)}} €
                            </td>
                            <td>
                                {{Form::open(array('route'=>array('timetracking.destroy',$timeentry->id),'method'=>'DELETE','style'=>'display:inline;border:none;margin:0;padding:0;'))}}
                                    {{csrf_field()}}
                                    <button style="background:none!important;border:none;padding:0!important;border-bottom:1px solid #444; " title="Delete entry">
                                        <i class="btn btn-danger fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                {{Form::close()}}
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