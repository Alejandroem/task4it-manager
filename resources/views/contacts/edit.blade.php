@extends('layout.app')
@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> New Row </div>
            <div class="card-body">
                {{Form::model($contact, array('route' => array('contacts.update', $contact->id),'method' => 'put'))}}
                    {{Form::submit('Save',['class'=>'btn btn-primary pull-right'])}}
                    <div class="row">
                        <div class="col-md-12">
                        @include('contacts.fields')
                        </div>
                    </div>
                {{Form::close() }}
            @include('layout.errors')
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
    $('select').change(function(){
        var me = $(this);
        var selected = $(this).find(":selected");
        me.css('background-color',selected.css('background-color'));
        me.css('font-color',selected.css('font-color'));

    });
@endsection
      
