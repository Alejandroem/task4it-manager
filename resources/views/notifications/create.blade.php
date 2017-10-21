@extends('layout.app')
@section('content')
<div class="container">
        {{Form::open(array('route' => array('notifications.store')))}}
            <div class="row">
                @include('notifications.fields')
            </div>
            {{Form::submit('Create',['class'=>'btn btn-primary'])}}
        {{Form::close() }}
    @include('layout.errors')
</div>
@stop

@section('script')
    
@endsection