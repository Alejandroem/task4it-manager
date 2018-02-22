@extends('layout.app')
@section('content')


<div class="card mb-3">
    <div class="card-header">
        @include('layout.errors')
         <div class="row">
            <div class="col-md-6">
                Manage Packages  
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary pull-right add" data-type="1">Add a Package </button> 
            </div>
        </div>
    </div>
   
    <div class="card-body">
        <div class="row" id="pannel">
            @foreach($packages as $package)
                @include('packages.package')
            @endforeach
        </div>
        
    </div>
</div>


@stop

@section('script')
$(document).ready(function(){
    $('body').on('click','.value',function(e){
        var id_value = $(this).data('idvalue');
        var me = $(this);
        e.preventDefault();
          swal({
            title: 'Enter the new value:',
            input: 'number',
            showCancelButton: true,
            confirmButtonText: 'Submit',
            showLoaderOnConfirm: true,
            preConfirm: function (value) {
                return new Promise(function (resolve, reject) {
                    $.ajax({
                        url: "{{URL::to('/values')}}/"+id_value,
                        data:{'_token':'{{ csrf_token() }}','new_value':value,'value':id_value},
                        type: "PUT",
                        success: function(response) {
                            console.log(me);
                            me.text(value);
                            resolve(value);
                        },
                        error: function(xhr) {
                            reject("Something went wrong");
                        }
                    });
                })
            },
            allowOutsideClick: false
        }).then(function (value) {
            swal({
                type: 'success',
                title: 'The value has been updated!',
                html: 'New option value: ' + value
            })
        });
    });

    $('body').on('click','.delete',function(e){
        e.preventDefault();
        var toDelete = $(this).data('id');
        console.log(toDelete);
        var type = $(this).data('type');
        console.log(type);
        var url = "";
        if(type === 1){
            url = "{{ URL::to('packages') }}/"+toDelete;
        }else if (type === 2) {
            url = "{{ URL::to('options') }}/"+toDelete;
        }else if (type === 3){
            url = "{{ URL::to('values') }}/"+toDelete;
        }
        console.log(url);
        swal({
            title: 'Are you sure you want to delete it?',
            showCancelButton: true,
            confirmButtonText: 'Submit',
            showLoaderOnConfirm: true,
            preConfirm: function () {
                $.ajax({
                    url: url,
                    data:{'_method': 'delete','_token':'{{ csrf_token() }}','_method':'DELETE'},
                    type: 'POST',
                    success: function(response) {
                        var del = "";
                        if(type === 1){
                            del = "#package-"+toDelete;
                        }else if (type === 2) {
                            del = "#option-"+toDelete;
                        }else if (type === 3){
                            del = "#value-"+toDelete;
                        }
                        console.log(del);
                        $(del).remove();
                        swal({
                            type: 'success',
                            title: 'The name has been deleted!'
                        })
                    },
                    error: function(xhr) {
                        console.log(xhr);
                    }
                });
                
            },
            allowOutsideClick: false
        });
    });

    $('body').on('click','.add',function(e){
        e.preventDefault();
        var type = $(this).data('type');
        var url = "";
        if(type === 1){
            url = "{{ route('packages.store') }}";
        }else if (type === 2) {
            url = "{{ route('options.store') }}";
        }else if (type=== 3){
            url = "{{ route('values.store') }}";
        }
        var parent = $(this).data('parent');

        swal({
            title: 'Enter the new name:',
            input: 'text',
            showCancelButton: true,
            confirmButtonText: 'Submit',
            showLoaderOnConfirm: true,
            preConfirm: function (name) {
                return new Promise(function (resolve, reject) {
                    $.ajax({
                        url: url,
                        data:{'_token':'{{ csrf_token() }}','name':name,'parent':parent},
                        type: "POST",
                        success: function(response) {
                            var id = response.id;
                            var name = response.name;
                            if(type === 1){
                                $('#pannel').append(@include('packages.javascripts.package'));
                            }else if (type === 2) {
                                $('#options-'+parent).append(@include('packages.javascripts.option'));
                            }else if (type=== 3){
                                $('#values-'+parent).append(@include('packages.javascripts.value'));
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

    
});
@stop