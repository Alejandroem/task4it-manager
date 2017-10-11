@extends('layout.app')
@section('content')

<!-- DataTables Card-->
<div class="row">
    <div class="col-md-4">
        <a class="btn btn-primary" href="{{route('projects.create')}}">Create new Project</a>
    </div>
</div>

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
                        <td>{{$project->name}}</td>
                        <td>{{$project->description}}</td>
                        <td>${{$project->budget}}</td>
                        <td>{{$project->created_at->toFormattedDateString()}}</td>
                        <td>
                            <a href="{{ route('projects.edit',['id'=>$project->id]) }}" title="Asign users">
                                <i class="btn btn-primary fa fa-user-plus fa-lg" aria-hidden="true"></i>
                            </a>
                            <a href="{{ route('projects.milestones.create',['id'=>$project->id]) }}" title="Create milestones">
                                <i class="btn btn-primary fa fa-flag fa-lg" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{--<div class="card-footer small text-muted">Updated today at 11:59 PM</div> --}}
</div>

@include('projects.milestones.create')

@stop

@section('script')
    @if(session()->has('error_code'))
    $(function() {
        $('#milestones').modal('show');

        $( "#percentage" ).change(function() {
            var max = parseInt($(this).attr('max'));
            var min = parseInt($(this).attr('min'));
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
            
            var max = $('#percentage').attr("max"); 
            $('#percentage').attr("max",max-percentage);
            
            $('#percentage').val('');
            var date = $('#due_to').val();
            $('#due_to').val('');
            if(date!=="" || percentage!=="" ){
                $("#milestones-list").append(`
                    <div class="row">
                        <input type=\"text\" class=\"form-control col-md-6 percentages\" readonly value=\"`+percentage+`\" name=\"percentages[]\">
                        <input type=\"text\" class=\"form-control col-md-5\" readonly value=\"`+date+`\" name=\"dates[]\">
                        <button type=\"button\" class=\"btn btn-danger col-md-1 delete-milestone\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></button>
                    </div>
                `);
                $(".delete-milestone").click(function(){
                    console.log($(this).siblings('.percentages'));
                    var percentage = $(this).siblings('.percentages').val();
                    console.log(percentage);
                    var max = $('#percentage').attr("max");
                    console.log(max); 
                    console.log(max+percentage); 
                    $('#percentage').attr("max",parseInt(max)+parseInt(percentage));
                    $(this).parent().remove();
                });
                
            }
            else{
                alert("Error: you must fill both fields");
            }

        });
    });
    @endif
@stop