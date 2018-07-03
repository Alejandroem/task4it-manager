@extends('layout.app')
@section('content')
<div class="card mb-3">
    <div class="card-header">
    <a class="btn btn-primary pull-right" href="{{route('invoices.create')}}">Create new invoice</a>
        <i class="fa fa-table"></i> Invoices </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        @hasanyrole('admin')
                            <th>
                                Name
                            </th>
                        @endhasanyrole
                            <th>
                                Projects
                            </th>
                        </tr>
                    </thead>
                    <hbody>
                        @foreach($developers as $developer)
                            <tr>
                            @hasanyrole('admin')
                                <td>
                                    {{$developer->name}}
                                </td>   
                            @endhasanyrole
                                <td>
                                @if(isset($developer->projects))
                                @foreach($developer->projects as $project)
                                    @if($loop->first)
                                        <a href="{{route('invoices.list',['project'=>$project->id,'developer'=>$developer->id])}}">{{$project->name}}</a>
                                    @else
                                        | <a href="{{route('invoices.list',['project'=>$project->id,'developer'=>$developer->id])}}">{{$project->name}}</a>
                                    @endif
                                @endforeach
                                @endif
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