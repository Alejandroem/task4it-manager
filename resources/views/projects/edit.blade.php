@extends('layout.app')
@section('content')
<div class="container">
        {{Form::model($project, array('route' => array('projects.update', $project->id),'method' => 'put'))}}
            <div class="row">
                <div class="col-md-6">
                    @include('projects.fields')
                </div>
                <div class="col-md-6">
                    {{Form::label('users', 'Add new users:')}}
                    {{Form::select('newUsers',$users,null,array('multiple'=>'multiple','name'=>'newUsers[]','class'=>'form-control'))}}
                </div>
            </div>
            {{Form::submit('Update project',['class'=>'btn btn-primary'])}}
        {{Form::close() }}
    @include('layout.errors')
</div>
@stop

@section('script')

@stop