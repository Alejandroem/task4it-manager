@extends('layout.app')
@section('content')
<div class="card mb-3">
    <div class="card-header">
        <a class="btn btn-primary pull-right" href="{{route('budgets.create')}}">Add Budget</a>
        <i class="fa fa-table"></i> Budgets </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>
                                Budget Name
                            </th>
                            <th>
                                Project
                            </th>
                            <th>
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <hbody>
                        @foreach($budgets as $budget)
                        <tr>
                            <td>
                                {{$budget->name}}
                            </td>
                            <td>
                                {{$budget->project? $budget->project : "Unassigned"}}
                            </td>
                            <td>
                                <a href="{{ route('budgets.export',['id'=>$budget->id]) }}" title="download">
                                    <i class="btn btn-primary fa fa-download fa-lg" aria-hidden="true"></i>
                                </a>
                                <a href="{{ route('budgets.edit',['id'=>$budget->id]) }}" title="Edit budget">
                                    <i class="btn btn-primary fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>
                                </a>
                                {{Form::open(array('route'=>array('budgets.destroy',$budget->id),'method'=>'DELETE','style'=>'display:inline;border:none;margin:0;padding:0;'))}}
                                    {{csrf_field()}}
                                    <button style="background:none!important;border:none;padding:0!important;border-bottom:1px solid #444; " title="Delete project">
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
        {{--<div class="card-footer small text-muted">Updated today at 11:59 PM</div> --}}
    </div>
</div>
@stop