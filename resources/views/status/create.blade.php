@extends('layout.app')
@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> New Row </div>
            <div class="card-body">
                {{Form::open(array('route' => array('status.store')))}}
                    {{Form::submit('Create',['class'=>'btn btn-primary pull-right'])}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    {{Form::label('font_color', 'Font Color:')}}
                                    <input name="font_color" type="color"  class="form-control" style="height:50px" required>
                                </div>
                            </div>
                            <div class="row my-4">
                                <div class="col-md-4">
                                    {{Form::label('background_color', 'Background Color:')}}
                                    <input name="background_color" type="color" class="form-control" style="height:50px" required>
                                </div>
                            </div>
                            <div class="row my-4">
                                <div class="col-md-4">
                                    {{Form::label('name', 'Status Name:')}}
                                    {{Form::text('name','',['class'=>'form-control','required'])}}
                                </div>
                            </div>
                        </div>
                    </div>
                {{Form::close() }}
            @include('layout.errors')
            </div>
        </div>
    </div>
</div>
@stop

      
