@extends('layout.app')
@section('content')

<!-- DataTables Card-->




<div class="card mb-3">
    <div class="card-header">
        @hasanyrole('admin|project-manager')
        <a class="btn btn-primary pull-right" href="{{route('projects.create')}}">Create new Project</a>
        @endhasanyrole
        <i class="fa fa-table"></i> Projects </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        @hasanyrole('admin|project-manager')
                        <th>Budget</th>
                        @endhasanyrole
                        <th>Created at</th>
                        
                        <th>Actions</th>
                        
                    </tr>
                </thead>
                {{--
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Created at</th>
                    </tr>
                </tfoot> --}}
                <tbody>
                    @foreach($projects as $project)
                    <tr>
                        <td>{{$project->id}}</td>
                        <td>{{$project->name}}</td>
                        <td>{{$project->description}}</td>
                        @hasanyrole('admin|project-manager')
                        <td>{{$project->budget}}€</td>
                        @endhasanyrole
                        <td>{{$project->created_at->toFormattedDateString()}}</td>
                        
                        <td>
                            @hasanyrole('admin|project-manager')
                            <a href="{{ route('projects.edit',['id'=>$project->id]) }}" title="Asign users">
                                <i class="btn btn-primary fa fa-info-circle fa-lg" aria-hidden="true"></i>
                            </a>
                            @if($project->milestones->count()==0)
                                <a href="{{ route('projects.milestones.create',['id'=>$project->id]) }}" title="Create milestones">
                                    <i class="btn btn-primary fa fa-flag fa-lg" aria-hidden="true"></i>
                                </a>
                            @else
                                <a href="{{ route('projects.milestones.index',['id'=>$project->id]) }}" title="Show milestones">
                                    <i class="btn btn-primary fa fa-flag-checkered fa-lg" aria-hidden="true"></i>
                                </a>
                            @endif
                            @endhasanyrole
                            <a href="{{ route('projects.show',['id'=>$project->id]) }}" title="View files" class="notify-container">
                                @if($project->newFilesNotifications()->count()>0)
                                    <span class="notify-bubble">{{$project->newFilesNotifications()->count()}}</span>
                                @endif
                                <i class="btn btn-primary fa fa-files-o fa-lg" aria-hidden="true"></i>
                            </a>
                            @hasanyrole('admin')
                            {{Form::open(array('route'=>array('projects.destroy',$project->id),'method'=>'DELETE','style'=>'display:inline;border:none;margin:0;padding:0;'))}}
                                {{csrf_field()}}
                                <button style="background:none!important;border:none;padding:0!important;border-bottom:1px solid #444; " title="Delete project">
                                    <i class="btn btn-danger fa fa-trash" aria-hidden="true"></i>
                                </button>
                            {{Form::close()}}
                            @endhasanyrole
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('layout.errors')
    {{--<div class="card-footer small text-muted">Updated today at 11:59 PM</div> --}}
</div>

@include('projects.milestones.create')

@stop

@section('script')


    @if(session()->has('error_code'))
    $(function() {
        $('#milestones').modal('show');

        $( "#percentage" ).change(function() {
            var max = parseFloat($(this).attr('max'));
            var min = parseFloat($(this).attr('min'));
            if ($(this).val() > max)
            {
                $(this).val(max);
            }
            else if ($(this).val() < min)
            {
                $(this).val(min);
            }
        }); 

        $('#add-to-list').click(function(){
            var percentage = $('#percentage').val();
            var date = $('#due_to').val();

            if(date!=="" && percentage!=="" ){
                var max = $('#percentage').attr("max");
                $('#percentage').attr("max",max-percentage);
                $('#percentage').val('');
                $('#due_to').val('');

                $("#milestones-list").append(`
                    <div class="row">
                        <input type=\"text\" class=\"form-control col-md-6 percentages\" readonly value=\"`+percentage+`\" name=\"percentages[]\">
                        <input type=\"text\" class=\"form-control col-md-5\" readonly value=\"`+date+`\" name=\"dates[]\">
                        <button type=\"button\" class=\"btn btn-danger col-md-1 delete-milestone\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></button>
                    </div>
                `);
                $(".delete-milestone").click(function(){
                    var percentage = $(this).siblings('.percentages').val();
                    var max = $('#percentage').attr("max");
                    $('#percentage').attr("max",parseFloat(max)+parseFloat(percentage));
                    $(this).parent().remove();
                    $("#create-milestones").prop('disabled',true);
                });
                var total = 0;
                $(".percentages").each(function(){
                    total += parseFloat($(this).val());
                });
                if(total===100)
                {
                    $("#create-milestones").prop('disabled',false);
                }    
            }
            else{
                alert("Error: you must fill both fields");
            }
        });
    });
    @endif
@stop