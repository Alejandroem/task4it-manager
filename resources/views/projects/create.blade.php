@extends('layout.app')
@section('content')
<div class="container">
        {{Form::model($project, array('route' => array('projects.store', $project->id)))}}
            <div class="row">
                <div class="col-md-6">
                    @include('projects.fields')
                </div>
                <div class="col-md-6">
                    <div class="form-group" >
                        <label for="text"> Create a new user?</label>
                        <input type="checkbox" id="toogle_user" name="toogle_user">
                    </div>
                    <div class="form-group" id="select-user">
                        {{Form::label('user', 'Project owner:')}}
                        {{Form::select('user', $users,null,['class' => 'form-control','placeholder' => 'Pick a user...'])}}
                    </div>
                    <div id="create-user" style="display:none">
                        @include('users.fields')
                    </div>
                </div>
            </div>
            {{Form::submit('Create',['class'=>'btn btn-primary'])}}
        {{Form::close() }}
    @include('layout.errors')
</div>

@stop
@section('script')
    $('#toogle_user').click(function(){
        $('#create-user').toggle();
        $('#select-user').toggle();
    });
@stop