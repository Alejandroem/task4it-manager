@extends('layout.app')
@section('content')
<div class="card mb-3">
    <div class="card-header">
        
        <a class="btn btn-primary pull-right @if(Auth::user()->hasRole('client')&& !Auth::user()->can('create')) disabled @endif" href="{{route('requirements.create',['type'=>$text,'project_sel'=>$project_sel])}}">Create new {{$text}}</a>

        <i class="fa fa-table"></i> {{$text}} </div>
    <div class="card-body">
        <table border="0" cellspacing="5" cellpadding="5" class="ml-2 my-2">
            <tbody>
                <tr>
                    <td>Project:</td>
                    <td>
                        <form action="{{ route('requirements.index',['type'=>$text,'project_sel'=>$project_sel]) }}" method="GET">
                            <input type="text" value="{{$text}}" name="type" hidden>
                            <select class="custom-select" id="project_sel" name="project_sel" >
                                <option value="">Select a project</option>
                                @foreach($projects as $key => $p)
                                <option @if($project_sel==$key) selected @endif value="{{$key}}">{{$p}}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary" type="submit">Filter</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="table-responsive">
            <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Project</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Estimated delivery</th>
                        <th>Created</th>
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
                    @foreach($requirements->where('status','<',3) as $requirement)
                    <tr>
                        <td>{{$requirement->id}}</td>
                        <td>{{$requirement->project->name}}</td>
                        <td>{{$requirement->title}}</td>
                        <td>
                            @include('requirements.description-modal')
                        </td>
                        <td class="text-center">
                            @if($requirement->status==1)
                                @hasanyrole('developer')
                                    {{Form::open(array('route' => array('requirements.status', 'requirement'=>$requirement->id,'status'=>2,'type'=>$text,'project_sel'=>$project_sel),'method'=>'POST'))}}
                                        {{Form::submit('Start',['class'=>'btn btn-primary'])}}
                                    {{Form::close()}}
                                @else
                                    <div class="alert alert-primary" role="alert">
                                        Created
                                    </div>
                                @endhasanyrole
                            @elseif($requirement->status==2)
                                @hasanyrole('developer')
                                    {{Form::open(array('route' => array('requirements.status', 'requirement'=>$requirement->id,'status'=>3,'type'=>$text,'project_sel'=>$project_sel),'method'=>'POST'))}}
                                        {{Form::submit('Finish',['class'=>'btn btn-primary'])}}
                                    {{Form::close()}}
                                @else
                                    <div class="alert alert-secondary" role="alert">
                                        ongoing
                                    </div>
                                @endhasanyrole
                            @elseif($requirement->status==3)
                                @hasanyrole('client')
                                    {{Form::open(array('route' => array('requirements.status', 'requirement'=>$requirement->id,'status'=>4,'type'=>$text,'project_sel'=>$project_sel),'method'=>'POST'))}}
                                        {{Form::submit('Accept',['class'=>'btn btn-primary'])}}
                                    {{Form::close()}}
                                    {{Form::open(array('route' => array('requirements.status', 'requirement'=>$requirement->id,'status'=>2,'type'=>$text,'project_sel'=>$project_sel),'method'=>'POST'))}}
                                        {{Form::submit('Reject',['class'=>'btn btn-primary'])}}
                                    {{Form::close()}}
                                    
                                @else
                                    <div class="alert alert-success" role="alert">
                                        Completed
                                    </div>
                                @endhasanyrole
                            @elseif($requirement->status==4)
                                <div class="alert alert-danger" role="alert">
                                    Finished
                                </div>
                            @endif
                        
                        </td>
                        <td>
                            @if($requirement->priority==0)
                                <div class="alert alert-success" role="alert">
                                    Low
                                </div>
                            @elseif($requirement->priority==1)
                                <div class="alert alert-warning" role="alert">
                                    Medium
                                </div>
                            @elseif($requirement->priority==2)
                                <div class="alert alert-danger" role="alert">
                                    High
                                </div>
                            @endif
                        </td>
                        <td>{{$requirement->due_to->toFormattedDateString()}}</td>
                        <td>{{$requirement->created_at->toFormattedDateString()}}</td>
                        <td>
                        <div class="row">
                            <a href="{{route('requirements.questions.index',['bug'=>$requirement->id])}}" data-toggle="tooltip" data-placement="top" title="Tooltip on top" class="notify-container">
                                @if($requirement->newQuestionsNotifications()>0)
                                    <span class="notify-bubble">{{$requirement->newQuestionsNotifications()}}</span>
                                @endif
                                <i class="btn btn-primary fa fa-comments fa-lg" aria-hidden="true"></i>
                            </a>
                            <a href="{{ route('requirements.show',['requirement'=>$requirement->id,'type'=>$text,'project_sel'=>$project_sel]) }}" title="View files" class="notify-container">
                                @if($requirement->newFilesNotifications()>0)
                                    <span class="notify-bubble">{{$requirement->newFilesNotifications()}}</span>
                                @endif
                                <i class="btn btn-primary fa fa-files-o fa-lg" aria-hidden="true"></i>
                            </a>
                            @hasanyrole('admin')
                            {{Form::open(array('route'=>array('notifications.destroy',$requirement->id,'type'=>$text,'project_sel'=>$project_sel),'method'=>'DELETE','style'=>'display:inline;border:none;margin:0;padding:0;'))}}
                                {{csrf_field()}}
                                <button style="background:none!important;border:none;padding:0!important;border-bottom:1px solid #444; " title="Delete {{$text}}">
                                    <i class="btn btn-danger fa fa-trash fa-lg" aria-hidden="true"></i>
                                </button>
                            {{Form::close()}}
                            @endhasanyrole
                        </div>
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @include('layout.errors')
        </div>
        <hr>
        <h4 class="ml-2">Finished</h4>
        <br>
             <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Project</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Estimated delivery</th>
                        <th>Created</th>
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
                    @foreach($requirements->where('status','>=',3) as $requirement)
                    <tr>
                        <td>{{$requirement->id}}</td>
                        <td>{{$requirement->project->name}}</td>
                        <td>{{$requirement->title}}</td>
                        <td>
                            @include('requirements.description-modal')
                        </td>
                        <td class="text-center">
                            @if($requirement->status==1)
                                @hasanyrole('developer')
                                    {{Form::open(array('route' => array('requirements.status', 'requirement'=>$requirement->id,'status'=>2,'type'=>$text,'project_sel'=>$project_sel),'method'=>'POST'))}}
                                        {{Form::submit('Start',['class'=>'btn btn-primary'])}}
                                    {{Form::close()}}
                                @else
                                    <div class="alert alert-primary" role="alert">
                                        Created
                                    </div>
                                @endhasanyrole
                            @elseif($requirement->status==2)
                                @hasanyrole('developer')
                                    {{Form::open(array('route' => array('requirements.status', 'requirement'=>$requirement->id,'status'=>3,'type'=>$text,'project_sel'=>$project_sel),'method'=>'POST'))}}
                                        {{Form::submit('Finish',['class'=>'btn btn-primary'])}}
                                    {{Form::close()}}
                                @else
                                    <div class="alert alert-secondary" role="alert">
                                        ongoing
                                    </div>
                                @endhasanyrole
                            @elseif($requirement->status==3)
                                @hasanyrole('client')
                                    {{Form::open(array('route' => array('requirements.status', 'requirement'=>$requirement->id,'status'=>4,'type'=>$text,'project_sel'=>$project_sel),'method'=>'POST'))}}
                                        {{Form::submit('Accept',['class'=>'btn btn-primary'])}}
                                    {{Form::close()}}
                                    {{Form::open(array('route' => array('requirements.status', 'requirement'=>$requirement->id,'status'=>2,'type'=>$text,'project_sel'=>$project_sel),'method'=>'POST'))}}
                                        {{Form::submit('Reject',['class'=>'btn btn-primary'])}}
                                    {{Form::close()}}
                                    
                                @else
                                    <div class="alert alert-success" role="alert">
                                        Completed
                                    </div>
                                @endhasanyrole
                            @elseif($requirement->status==4)
                                <div class="alert alert-danger" role="alert">
                                    Finished
                                </div>
                            @endif
                        
                        </td>
                        <td>
                            @if($requirement->priority==0)
                                <div class="alert alert-success" role="alert">
                                    Low
                                </div>
                            @elseif($requirement->priority==1)
                                <div class="alert alert-warning" role="alert">
                                    Medium
                                </div>
                            @elseif($requirement->priority==2)
                                <div class="alert alert-danger" role="alert">
                                    High
                                </div>
                            @endif
                        </td>
                        <td>{{$requirement->due_to->toFormattedDateString()}}</td>
                        <td>{{$requirement->created_at->toFormattedDateString()}}</td>
                        <td>
                        <div class="row">
                            <a href="{{route('requirements.questions.index',['bug'=>$requirement->id])}}" data-toggle="tooltip" data-placement="top" title="Tooltip on top" class="notify-container">
                                @if($requirement->newQuestionsNotifications()>0)
                                    <span class="notify-bubble">{{$requirement->newQuestionsNotifications()}}</span>
                                @endif
                                <i class="btn btn-primary fa fa-comments fa-lg" aria-hidden="true"></i>
                            </a>
                            <a href="{{ route('requirements.show',['requirement'=>$requirement->id,'type'=>$text,'project_sel'=>$project_sel]) }}" title="View files" class="notify-container">
                                @if($requirement->newFilesNotifications()>0)
                                    <span class="notify-bubble">{{$requirement->newFilesNotifications()}}</span>
                                @endif
                                <i class="btn btn-primary fa fa-files-o fa-lg" aria-hidden="true"></i>
                            </a>
                            @hasanyrole('admin')
                            {{Form::open(array('route'=>array('notifications.destroy',$requirement->id,'type'=>$text,'project_sel'=>$project_sel),'method'=>'DELETE','style'=>'display:inline;border:none;margin:0;padding:0;'))}}
                                {{csrf_field()}}
                                <button style="background:none!important;border:none;padding:0!important;border-bottom:1px solid #444; " title="Delete {{$text}}">
                                    <i class="btn btn-danger fa fa-trash fa-lg" aria-hidden="true"></i>
                                </button>
                            {{Form::close()}}
                            @endhasanyrole
                        </div>
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
    {{--<div class="card-footer small text-muted">Updated today at 11:59 PM</div> --}}
</div>
@stop

@section('script')
   /*
    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            var project = $('#project').val().toUpperCase();
            var name = data[1].toUpperCase();
            if (name.indexOf(project)>=0)
            {
                return true;
            }
            return false;
        }
    );
    */
    $(document).ready(function() {
        $('.dataTable').each(function(){
            $(this).DataTable();
        });
        /*
        $('#project').change( function() {
            console.log($("a"));
            var sel = $(this);
            console.log(window.location.href);
            window.location = window.location.href + "&project="+sel.val();

            
            $("form").each(function(){
                var currentUrl = window.location.href;
                var parsedUrl = $.url(currentUrl);
                var params = parsedUrl.param();
                params["project"] = sel.val();
                var newUrl = "?" + $.param(params);
                $(this).attr('action', newUrl)
            });
            console.log($("form"))
            
            $('.dataTable').each(function(){
                $(this).DataTable().draw();
            });
        } );
        */
    } );

@stop