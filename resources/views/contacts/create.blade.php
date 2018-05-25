@extends('layout.app')
@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> New Row </div>
            <div class="card-body">
                {{Form::open(array('route' => array('contacts.store')))}}
                    {{Form::submit('Create',['class'=>'btn btn-primary pull-right'])}}
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
    const NONE = "";
    $('#countries').change(function(){
        var selected = $(this).find(":selected");
        var filtered_cities;
        if(selected.val().localeCompare(NONE)==0){
            filtered_cities = $("#all_cities option");
        }else{
            filtered_cities = $('#all_cities [data-country="'+selected.val()+'"]');
        }
        $('#city').html(filtered_cities.clone());
    });
    $('#city').change(function(){
        
        $('#countries').val($(this).find(":selected").data('country'));

        var selected = $('#countries').find(":selected");
        var filtered_cities;
        if(selected.val().localeCompare(NONE)==0){
            filtered_cities = $("#all_cities option");
        }else{
            filtered_cities = $('#all_cities [data-country="'+selected.val()+'"]');
        }
        $('#city').html(filtered_cities.clone());
    });

@endsection
      
      
