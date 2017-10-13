@extends('layout.app')
@section('content')

<!-- DataTables Card-->
@hasanyrole('admin|project-manager')
<div class="row">
    <div class="col-md-4">
        <a class="btn btn-primary" href="{{route('projects.create')}}">Create new Project</a>
    </div>
</div>
@endhasanyrole

<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-table"></i> Projects </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Budget</th>
                        <th>Created at</th>
                        @hasanyrole('admin|project-manager')
                        <th>Actions</th>
                        @endhasanyrole
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
                        <td>{{$project->name}}</td>
                        <td>{{$project->description}}</td>
                        <td>${{$project->budget}}</td>
                        <td>{{$project->created_at->toFormattedDateString()}}</td>
                        @hasanyrole('admin|project-manager')
                        <td>
                            <a href="{{ route('projects.edit',['id'=>$project->id]) }}" title="Asign users">
                                <i class="btn btn-primary fa fa-user-plus fa-lg" aria-hidden="true"></i>
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
                        </td>
                        @endhasanyrole
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