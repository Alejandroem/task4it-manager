@extends('layout.app')
@section('content')
<div class="container">
        {{Form::model($project, array('route' => array('projects.store', $project->id)))}}
            <div class="row">
                <div class="col-md-6">
                    @include('projects.fields')
                </div>
                <div class="col-md-6">
                    <div class="form-group" >
                        <label for="text"> Create a new user?</label>
                        <input type="checkbox" id="toogle_user" name="toogle_user">
                    </div>
                    <div class="form-group" id="select-user">
                        {{Form::label('user', 'Project owner:')}}
                        {{Form::select('user', $users,null,['class' => 'form-control','placeholder' => 'Pick a user...'])}}
                    </div>
                    <div id="create-user" style="display:none">
                        @include('users.fields')
                    </div>
                    @hasanyrole('admin')
                    <br>
                    <hr>
                    <input type="text" id="requirements-list" name="requirements-list" hidden>
                    <div class="form-group req-grid">
                        <div class="row my-2">
                            <div class="col-md-12">
                                <div class="pull-right">
                                    <button type="button" class="btn btn-primary" id="new-req">New requirement name</button>
                                    <button type="button" class="btn btn-primary" id="export" >Export</button>
                                    <button type="button" class="btn btn-primary add" id="add" data-id="0">></button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="req-panel" data-id="0" data-children="0">
                                @if(count($errors))
                                    {!! old('requirements-list') !!} 
                                @endif
                            </div>
                        </div>
                    </div>
                    @endhasanyrole
                </div>
            </div>
           
            {{Form::submit('Create',['class'=>'btn btn-primary', 'id'=>'create'])}}
        {{Form::close() }}
    @include('layout.errors')
</div>

@stop
@section('script')
    $(document).on("change","select",function(){
        $("option[value=" + this.value + "]", this)
        .attr("selected", true).siblings()
        .removeAttr("selected")
    });

    $("#create").click(function(){
        var requirements = $('.req-panel[data-id=0]').html();
        $("#requirements-list").val(requirements);
    });

    $("#export").click(function(){
        var requirements = new Array();
        console.log("afterbla");
        $('.req').each(function(){
            var requirement = new Object();
            var id = $(this).data('id');
            requirement.id = id;
            requirement.parent = $(this).data('parent');
            requirement.rate = $('.admin-rate[data-id='+id+']').val();
            requirement.name_id = $('.requirements[data-id='+id+']').val();
            var count = (id.match(/-/g) || []).length;
            requirement.level = count -1;
            requirements.push(requirement);
        });
        console.log(requirements);
        window.open("{{ route('project.export') }}?message="+JSON.stringify(requirements),'_blank');
    });

    $("#new-req").click(function(){
        swal({
            title: 'Enter the new name of the requirement',
            input: 'text',
            showCancelButton: true,
            confirmButtonText: 'Submit',
            showLoaderOnConfirm: true,
            preConfirm: function (name) {
                return new Promise(function (resolve, reject) {
                    $.ajax({
                        url: "{{ route('names.store') }}",
                        data:{'_token':'{{ csrf_token() }}','name':name},
                        type: "POST",
                        success: function(response) {
                            $(".requirements").append($('<option>', {
                                value: response.id,
                                text: response.name
                            }));
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
        })
    });

    $("body").on('click','.add',function(){
        var id = $(this).data('id');
        var children = $('.req-panel[data-id='+id+']').data('children');
        $('.req-panel[data-id='+id+']').data('children',children+1);
        $('.req-panel[data-id='+id+']').append(@include('projects.requirement'));
        
    });  
    $("body").on('click','.del',function(){
        var id = $(this).data('id');
        $('.req[data-id='+id+']').remove();
    });  

    $('#toogle_user').click(function(){
        $('#create-user').toggle();
        $('#select-user').toggle();
    });
@stop