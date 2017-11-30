@extends('layout.app')
@section('content')
<div class="card mb-3">
    <div class="card-header">
        <a class="btn btn-primary pull-right" href="{{route('proposal.create')}}">Create new proposal</a>
        <i class="fa fa-table"></i> Proposals </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Description</th>
                        <th>Created at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proposals as $proposal)
                        <tr>
                            <td>{{$proposal->company}}</td>                   
                            <td>{{$proposal->object}}</td>                   
                            <td>{{$proposal->created_at->toFormattedDateString()}}</td>                   
                            <td>
                                <a href="{{ route('proposal.export',['id'=>$proposal->id]) }}" title="Export proposal" target="_blank">
                                    <i class="btn btn-primary fa fa-download fa-lg" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop