@extends('layout.app')
@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> New Time Entry </div>
            <div class="card-body">
                {{Form::open(array('route' => array('timetracking.store')))}}
                    {{Form::submit('Create',['class'=>'btn btn-primary pull-right'])}}
                    <div class="row">
                        <div class="col-md-12">
                        @include('timeentries.fields')
                        </div>
                    </div>
                {{Form::close() }}
            @include('layout.errors')
            </div>
        </div>
    </div>
</div>
@stop