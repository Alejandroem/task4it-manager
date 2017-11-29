@extends('layout.app')
@section('content')
<div class="container">
        {{Form::open(array('route' => array('proposal.store')))}}
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

@section('script')
    $("body").on('click','.add',function(){
        var selector = $(this).data('class');
        var html = `@include('proposals.milestones')`;
        if(selector==="team"){
            html = `@include('proposals.team')`;
        }
        $(this).parent().parent().after(html);
    });  
    $("body").on('click','.del',function(){
        $(this).parent().parent().remove();
    });  
@stop
