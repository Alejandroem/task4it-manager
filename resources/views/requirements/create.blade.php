@extends('layout.app')
@section('content')
<div class="container">
        {{Form::model($requirement, array('route' => array('requirements.store', $requirement->id)))}}
            @include('requirements.fields')
            {{Form::submit('Create',['class'=>'btn btn-primary'])}}
        {{Form::close() }}
    @include('layout.errors')
</div>
@stop
@section('script')
    $(document).ready(function() {
        $('.datepicker').datepicker();
    });
@stop