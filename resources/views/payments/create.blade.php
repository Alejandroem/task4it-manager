@extends('layout.app')
@section('content')
<div class="container">
        {{Form::open(array('route' => array('payments.store', $payment->id),'files'=>true))}}
            <div class="row">
                @include('payments.fields')
            </div>
            {{Form::submit('Create',['class'=>'btn btn-primary'])}}
        {{Form::close() }}
    @include('layout.errors')
</div>
@stop
