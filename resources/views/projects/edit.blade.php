@extends('layout.app')
@section('content')
<div class="container">
        {{Form::model($project, array('route' => array('projects.update', $project->id),'method' => 'put'))}}
            <div class="row">
                <div class="col-md-6">
                    @include('projects.fields')
                </div>
                <div class="col-md-6">
                    {{Form::label('users', 'Add new users:')}}
                    {{Form::select('newUsers',$users,null,array('multiple'=>'multiple','name'=>'newUsers[]','class'=>'form-control'))}}
                    @hasanyrole('admin')
                    <br>
                    <hr>
                    <input type="text" id="requirements-list" name="requirements-list" hidden>
                    <div class="form-group req-grid" >
                        <div class="row my-2">
                            <div class="col-md-12">
                                <div class="pull-right">
                                    <button type="button" class="btn btn-primary" id="new-req">New requirement name</button>
                                    <button type="button" class="btn btn-primary" id="export">Export</button>
                                    <button type="button" class="btn btn-primary add" id="add" data-id="0">></button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="req-panel" data-id="0" data-children="0">
                                {!! $project->requirements !!} 
                            </div>
                        </div>
                    </div>
                    @endhasanyrole
                </div>
            </div>
            {{Form::submit('Update project',['class'=>'btn btn-primary','id'=>'save'])}}
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

    $(document).ready(function(){
        $(".requirements").each(function(){
            @foreach($requirements as $key => $requirement)
                if($("option[value='{{$key}}']",this).length === 0){
                    $(this).append($('<option>', {
                        value: {{$key}},
                        text: '{{$requirement}}'
                    }));
                }
            @endforeach
        });
        
    });

    $("#save").click(function(){
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
        console.log($('.req[data-id='+id+']'));
    });   
@stop