@extends('layout.app')
@section('content')
<div class="container">
        {{Form::model($user, array('route' => array('users.store', $user->id)))}}
            <div class="row">
                <div class="col-md-6">
                   @include('users.fields')
                </div>
            </div>
            {{Form::submit('Create',['class'=>'btn btn-primary'])}}
        {{Form::close() }}
    @include('layout.errors')
</div>
@stop
