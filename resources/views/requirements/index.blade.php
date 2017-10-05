@extends('layout.app')
@section('content')

<!-- DataTables Card-->
<div class="row">
    <div class="col-md-4">
        <a class="btn btn-primary" href="{{route('requirements.create',['type'=>$text])}}">Create new {{$text}}</a>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-table"></i> {{$text}} </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Rate</th>
                        <th>Percentage</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Payed</th>
                        <th>Due to</th>
                        <th>Created</th>
                    </tr>
                </thead>
                {{--
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Created at</th>
                    </tr>
                </tfoot> --}}
                <tbody>
                    @foreach($requirements as $requirement)
                    <tr>
                        <td>{{$requirement->project->name}}</td>
                        <td>{{$requirement->title}}</td>
                        <td>{{$requirement->description}}</td>
                        <td>{{$requirement->rate}}</td>
                        <td>{{$requirement->percentage}}</td>
                        <td>{{$requirement->status}}</td>
                        <td>{{$requirement->priority}}</td>
                        <td>{{$requirement->due_to->toFormattedDateString()}}</td>
                        <td>{{$requirement->created_at->toFormattedDateString()}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{--<div class="card-footer small text-muted">Updated today at 11:59 PM</div> --}}
</div>
@stop