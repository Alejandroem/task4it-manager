@extends('layout.app')
@section('content')
<div class="card mb-3">
    <div class="card-header">
        
        <i class="fa fa-table"></i> Contacts </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                    <thead>
                        <tr>
                            <th>
                                Name
                            </th>
                            <th>
                                Projects
                            </th>
                        </tr>
                    </thead>
                    <hbody>
                        @foreach($developers as $developer)
                            <tr>
                                <td>
                                    {{$developer->name}}
                                </td>   
                                <td>
                                @foreach($developer->projects as $project)
                                    @if($loop->first)
                                        <a href="{{route('invoices.list',['project'=>$project->id,'developer'=>$developer->id])}}">{{$project->name}}</a>
                                    @else
                                        | <a href="{{route('invoices.list',['project'=>$project->id,'developer'=>$developer->id])}}">{{$project->name}}</a>
                                    @endif
                                @endforeach
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