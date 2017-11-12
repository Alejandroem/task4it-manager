@extends('layout.app')
@section('content')
<div class="container">
        {{ Form::open(array('route' => array('requirements.questions.store','requirement'=>$requirement->id),'method'=>'POST')) }}
            {{Form::token()}}
            <div class="row">
                <div class="col-md-6">
                   {{Form::textarea('response',null,['class'=>'form-control'])}}
                </div>
            </div>
            {{Form::submit('Create',['class'=>'btn btn-primary'])}}
        {{Form::close() }}
    @include('layout.errors')
</div>
@stop
