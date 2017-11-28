@extends('layout.app')
@section('content')
<div class="container">
        {{Form::open(array('route' => array('users.store')))}}
            {{Form::submit('Create',['class'=>'btn btn-primary pull-right'])}}
            <div class="row">
                <div class="col-md-12">
                   @include('proposals.fields')
                </div>
            </div>
        {{Form::close() }}
    @include('layout.errors')
</div>
@stop
