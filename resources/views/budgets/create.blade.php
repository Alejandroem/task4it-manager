@extends('layout.app')
@section('content')

{!! Form::open(['route'=>'budgets.store']) !!}

<div class="card mb-3">
    <div class="card-header">
        @include('layout.errors')
        <div class="row">
            <div class="col-md-2">
                Create budget  
            </div>
            <div class="col-md-1">
                {!! Form::label('name', 'Budget Name') !!}                                
            </div>
            <div class="col-md-2">
                {!! Form::text("name", "", ['class'=>'form-control']) !!}
            </div>
            <div class="col-md-1">
                {!! Form::label('project', 'Project:') !!}
            </div>
            <div class="col-md-2">
                {!! Form::select("project", $projects, null,['class'=>'form-control','placeholder'=>'Select a project']) !!}
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary pull-right add">Add Requirement </button> 
            </div>
            <div class="col-md-2">
                <button id="export" type="submit" class="btn btn-primary pull-right">Export</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row" id="pannel">
            
            @foreach($names as $name)
            @include('requirements.names.name')
            @endforeach
        </div>
        
    </div>
</div>

{!! Form::close() !!}

@stop

@section('script')
$(document).ready(function(){
    
    $('body').on('click','.add',function(e){
        e.preventDefault();
        var parent = $(this).data('parent');
        parent = parent? parent: -1;
        console.log("Parent", parent);
        swal({
            title: 'Enter the new name:',
            input: 'text',
            showCancelButton: true,
            confirmButtonText: 'Submit',
            showLoaderOnConfirm: true,
            preConfirm: function (name) {
                return new Promise(function (resolve, reject) {
                    $.ajax({
                        url: "{{ route('names.store') }}",
                        data:{'_token':'{{ csrf_token() }}','name':name,'parent':parent},
                        type: "POST",
                        success: function(response) {
                            var id = response.id;
                            var name = response.name;
                            if(parent==-1){
                                $('#pannel').append(
                                `
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">
                                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    `+name+`<button class="btn btn-primary add" data-parent="`+id+`">Add SubReq</button>      
                                                </button>
                                            </h5>
                                        </div>
                                        
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group" id="subrequirements-`+id+`">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `
                                );
                            }else{
                                $('#subrequirements-'+parent).append(
                                `
                                <div class="form-group" >
                                    <div class="row">
                                        <div class="col-md-7">
                                            <label for="`+name+`" class="form-control">`+name+`</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input class="form-control" name="`+name+`" type="checkbox" id="`+name+`-check">
                                        </div>
                                        <div class="col-md-3">
                                            <input class="form-control" min="0" name="`+name+`-amount" type="number" value="0">
                                        </div>
                                    </div>
                                </div>
                                `
                                );
                                
                            }
                            console.log(response);
                            resolve();
                        },
                        error: function(xhr) {
                            reject("Something went wrong");
                        }
                    });
                })
            },
            allowOutsideClick: false
        }).then(function (name) {
            swal({
                type: 'success',
                title: 'The name has been added!',
                html: 'New requirement name: ' + name
            })
        });
    });
    //updateNames();
});

function updateNames(){
    $.ajax({
        url:"{{route('names.index')}}",
        {{--  data:{'_token':'{{ csrf_token() }}'},  --}}
        type: "GET",
        success: function(response) {
            if(response.names){
                $.each( response.names, function( index, value ){
                    console.log(value);
                });
            }
        },
        error: function(xhr) {
            console.log(xhr);
        }
    });
};
@stop