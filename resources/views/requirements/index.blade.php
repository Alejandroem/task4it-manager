@extends('layout.app')
@section('content')
<div class="card mb-3">
    <div class="card-header">
        
        <a class="btn btn-primary pull-right @if(Auth::user()->hasRole('client')&& !Auth::user()->can('create')) disabled @endif" href="{{route('requirements.create',['type'=>$text])}}">Create new {{$text}}</a>

        <i class="fa fa-table"></i> {{$text}} </div>
    <div class="card-body">
        <table border="0" cellspacing="5" cellpadding="5" class="ml-2 my-2">
            <tbody>
                <tr>
                    <td>Project:</td>
                    <td>
                        <select class="custom-select" id="project" name="project">
                            <option value ="" selected>All projects</option>
                            @foreach($projects as $project)
                            <option value="{{$project}}">{{$project}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="table-responsive">
            <table class="table table-bordered dataTable"  width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Project</th>
                        <th>Title</th>
                        <th>Description</th>
                        @hasanyrole('admin|project-manager|developer')
                        <th>Rate</th>
                        @endhasanyrole
                        @hasanyrole('admin')
                        <th>Admin rate</th>
                        @endhasanyrole
                        @hasanyrole('admin|client') 
                        <th>Total</th>
                        @endhasanyrole
                        <th>Status</th>
                        <th>Priority</th>
                        @hasanyrole('admin')
                        <th>Payed</th>
                        @endhasanyrole
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
                        <td>{{$requirement->description}}</td>
                        
                        
                        @if($requirement->rate===null)
                            @if(Auth::user()->hasAnyRole('developer'))
                            <td>
                                {{Form::model($requirement, array('route' => array('requirements.updateRate', 'requirement'=>$requirement->id,'type'=>$text),'method'=>'POST'))}}
                                <div class="row">
                                    <div class="col">
                                        {{Form::number('rate', null,['min'=>'0','class' => 'form-control'])}}
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary"><i class="fa fa-check-circle-o" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                                {{Form::close()}}
                            </td>
                            @elseif(Auth::user()->hasAnyRole('admin|project-manager'))
                            <td>
                                Waiting for developer response
                            </td>
                            @endif
                        @elseif(Auth::user()->hasAnyRole('admin|project-manager|developer'))
                        <td>
                            {{number_format($requirement->rate,2)}}€
                        </td>
                        @endif
                        
                        
                        @hasanyrole('admin')
                        <td>
                        @if($requirement->percentage===null)
                            {{Form::model($requirement, array('route' => array('requirements.updatePercentage', $requirement->id,'type'=>$text),'method'=>'POST'))}}
                            <div class="row">
                                <div class="col">
                                    {{Form::number('percentage', null,['min'=>0, 'step'=>'any', 'class' => 'form-control'])}}
                                </div>
                                <div class="col">
                                    <button class="btn btn-primary"><i class="fa fa-check-circle-o" aria-hidden="true"></i></button>
                                </div>
                            </div>
                            {{Form::close()}}
                            {{--  Waiting for admin response  --}}
                        @else
                            {{number_format($requirement->percentage)." €"}}
                        @endif
                        </td>
                        @endhasanyrole

                        @hasanyrole('admin|client')    
                        <td>
                        @if($requirement->percentage===null||$requirement->rate===null)
                            Not available yet
                        @else
                            {{number_format($requirement->rate+$requirement->percentage + $requirement->rate,2)}}€
                        @endif
                        @endhasanyrole
                        </td>
                        <td class="text-center">
                        @if($requirement->status==1)
                            @if($requirement->percentage!==null&&$requirement->rate!==null)
                                @if(Auth::user()->hasRole('client'))
                                    {{Form::open(array('route' => array('requirements.status', 'requirement'=>$requirement->id,'status'=>2,'type'=>$text),'method'=>'POST'))}}
                                        {{Form::submit('Approve',['class'=>'btn btn-primary'])}}
                                    {{Form::close()}}
                                    {{Form::open(array('route' => array('requirements.status', 'requirement'=>$requirement->id,'status'=>5,'type'=>$text),'method'=>'POST'))}}
                                        {{Form::submit('Reject',['class'=>'btn btn-primary'])}}
                                    {{Form::close()}}
                                @else
                                    <div class="alert alert-primary" role="alert">
                                        Created
                                    </div>
                                @endif
                            @else 
                                <div class="alert alert-primary" role="alert">
                                    Created
                                </div>
                            @endif
                        @elseif($requirement->status==2)
                        @hasanyrole('developer')
                            @if($requirement->status == 2)
                                {{Form::open(array('route' => array('requirements.status', 'requirement'=>$requirement->id,'status'=>3,'type'=>$text),'method'=>'POST'))}}
                                    {{Form::submit('Finish',['class'=>'btn btn-primary'])}}
                                {{Form::close()}}
                            @endif
                        @else
                            <div class="alert alert-secondary" role="alert">
                                ongoing
                            </div>
                        @endhasanyrole
                        @elseif($requirement->status==3)
                        {{--  @hasanyrole('client')
                            
                            {{Form::open(array('route' => array('requirements.status', 'requirement'=>$requirement->id,'status'=>4,'type'=>$text),'method'=>'POST'))}}
                                {{Form::submit('Accept',['class'=>'btn btn-primary'])}}
                            {{Form::close()}}
                            {{Form::open(array('route' => array('requirements.status', 'requirement'=>$requirement->id,'status'=>2,'type'=>$text),'method'=>'POST'))}}
                                {{Form::submit('Reject',['class'=>'btn btn-primary'])}}
                            {{Form::close()}}
                            
                        @else  --}}
                            <div class="alert alert-success" role="alert">
                                Completed
                            </div>
                        {{--  @endhasanyrole  --}}
                        @elseif($requirement->status==4)
                        <div class="alert alert-warning" role="alert">
                            Awaiting Payment
                        </div>
                        @elseif($requirement->status==5)
                        <div class="alert alert-danger" role="alert">
                            Rejected
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
                        @hasanyrole('admin')
                        <td>
                            @if($requirement->payed)
                                <div class="alert alert-success" role="alert">
                                Payed
                                </div>
                            @else
                                <div class="alert alert-danger" role="alert">
                                Pending
                                </div>
                            @endif
                        </td>
                        @endhasanyrole
                        <td>{{$requirement->due_to->toFormattedDateString()}}</td>
                        <td>{{$requirement->created_at->toFormattedDateString()}}</td>
                        <td>
                        <div class="row">
                            <a href="{{route('requirements.questions.index',['bug'=>$requirement->id])}}" data-toggle="tooltip" data-placement="top" title="Tooltip on top" class="notify-container">
                                @if($requirement->newQuestionsNotifications()->count()>0)
                                    <span class="notify-bubble">{{$requirement->newQuestionsNotifications()->count()}}</span>
                                @endif
                                <i class="btn btn-primary fa fa-comments fa-lg" aria-hidden="true"></i>
                            </a>
                            <a href="{{ route('requirements.show',['requirement'=>$requirement->id,'type'=>$text]) }}" title="View files" class="notify-container">
                                @if($requirement->newFilesNotifications()->count()>0)
                                    <span class="notify-bubble">{{$requirement->newFilesNotifications()->count()}}</span>
                                @endif
                                <i class="btn btn-primary fa fa-files-o fa-lg" aria-hidden="true"></i>
                            </a>
                            @hasanyrole('admin')
                            {{Form::open(array('route'=>array('notifications.destroy',$requirement->id,'type'=>$text),'method'=>'DELETE','style'=>'display:inline;border:none;margin:0;padding:0;'))}}
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
        <div class="table-responsive">
            <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Project</th>
                        <th>Title</th>
                        <th>Description</th>
                        @hasanyrole('admin|project-manager|developer')
                        <th>Rate</th>
                        @endhasanyrole
                        @hasanyrole('admin')
                        <th>Admin rate</th>
                        @endhasanyrole
                        @hasanyrole('admin|client') 
                        <th>Total</th>
                        @endhasanyrole
                        <th>Status</th>
                        <th>Priority</th>
                        @hasanyrole('admin')
                        <th>Payed</th>
                        @endhasanyrole
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
                        <td>{{$requirement->description}}</td>
                        
                        
                        @if($requirement->rate===null)
                            @if(Auth::user()->hasAnyRole('developer'))
                            <td>
                                {{Form::model($requirement, array('route' => array('requirements.updateRate', 'requirement'=>$requirement->id,'type'=>$text),'method'=>'POST'))}}
                                <div class="row">
                                    <div class="col">
                                        {{Form::number('rate', null,['min'=>'0','class' => 'form-control'])}}
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary"><i class="fa fa-check-circle-o" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                                {{Form::close()}}
                            </td>
                            @elseif(Auth::user()->hasAnyRole('admin|project-manager'))
                            <td>
                                Waiting for developer response
                            </td>
                            @endif
                        @elseif(Auth::user()->hasAnyRole('admin|project-manager|developer'))
                        <td>
                            {{number_format($requirement->rate,2)}}€
                        </td>
                        @endif
                        
                        
                        @hasanyrole('admin')
                        <td>
                        @if($requirement->percentage===null)
                            {{Form::model($requirement, array('route' => array('requirements.updatePercentage', $requirement->id,'type'=>$text),'method'=>'POST'))}}
                            <div class="row">
                                <div class="col">
                                    {{Form::number('percentage', null,['min'=>0, 'step'=>'any', 'class' => 'form-control'])}}
                                </div>
                                <div class="col">
                                    <button class="btn btn-primary"><i class="fa fa-check-circle-o" aria-hidden="true"></i></button>
                                </div>
                            </div>
                            {{Form::close()}}
                            {{--  Waiting for admin response  --}}
                        @else
                            {{number_format($requirement->percentage)." €"}}
                        @endif
                        </td>
                        @endhasanyrole

                        @hasanyrole('admin|client')    
                        <td>
                        @if($requirement->percentage===null||$requirement->rate===null)
                            Not available yet
                        @else
                            {{number_format($requirement->rate+$requirement->percentage + $requirement->rate,2)}}€
                        @endif
                        @endhasanyrole
                        </td>
                        <td class="text-center">
                        @if($requirement->status==1)
                            @if($requirement->percentage!==null&&$requirement->rate!==null)
                                @if(Auth::user()->hasRole('client'))
                                    {{Form::open(array('route' => array('requirements.status', 'requirement'=>$requirement->id,'status'=>2,'type'=>$text),'method'=>'POST'))}}
                                        {{Form::submit('Approve',['class'=>'btn btn-primary'])}}
                                    {{Form::close()}}
                                    {{Form::open(array('route' => array('requirements.status', 'requirement'=>$requirement->id,'status'=>5,'type'=>$text),'method'=>'POST'))}}
                                        {{Form::submit('Reject',['class'=>'btn btn-primary'])}}
                                    {{Form::close()}}
                                @else
                                    <div class="alert alert-primary" role="alert">
                                        Created
                                    </div>
                                @endif
                            @else 
                                <div class="alert alert-primary" role="alert">
                                    Created
                                </div>
                            @endif
                        @elseif($requirement->status==2)
                        @hasanyrole('developer')
                            @if($requirement->status == 2)
                                {{Form::open(array('route' => array('requirements.status', 'requirement'=>$requirement->id,'status'=>3,'type'=>$text),'method'=>'POST'))}}
                                    {{Form::submit('Finish',['class'=>'btn btn-primary'])}}
                                {{Form::close()}}
                            @endif
                        @else
                            <div class="alert alert-secondary" role="alert">
                                ongoing
                            </div>
                        @endhasanyrole
                        @elseif($requirement->status==3)
                        @hasanyrole('client')
                            
                            {{Form::open(array('route' => array('requirements.status', 'requirement'=>$requirement->id,'status'=>4,'type'=>$text),'method'=>'POST'))}}
                                {{Form::submit('Accept',['class'=>'btn btn-primary'])}}
                            {{Form::close()}}
                            {{Form::open(array('route' => array('requirements.status', 'requirement'=>$requirement->id,'status'=>2,'type'=>$text),'method'=>'POST'))}}
                                {{Form::submit('Reject',['class'=>'btn btn-primary'])}}
                            {{Form::close()}}
                            
                        @else
                            <div class="alert alert-success" role="alert">
                                Completed
                            </div>
                        @endhasanyrole
                        @elseif($requirement->status==4)
                        <div class="alert alert-warning" role="alert">
                            Awaiting Payment
                        </div>
                        @elseif($requirement->status==5)
                        <div class="alert alert-danger" role="alert">
                            Rejected
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
                        @hasanyrole('admin')
                        <td>
                            @if($requirement->payed)
                                <div class="alert alert-success" role="alert">
                                Payed
                                </div>|
                            @else
                                <div class="alert alert-danger" role="alert">
                                Pending
                                </div>
                            @endif
                        </td>
                        @endhasanyrole
                        <td>{{$requirement->due_to->toFormattedDateString()}}</td>
                        <td>{{$requirement->created_at->toFormattedDateString()}}</td>
                        <td>
                        <div class="row">
                            <a href="{{route('requirements.questions.index',['bug'=>$requirement->id])}}" data-toggle="tooltip" data-placement="top" title="Tooltip on top" class="notify-container">
                                @if($requirement->newQuestionsNotifications()->count()>0)
                                    <span class="notify-bubble">{{$requirement->newQuestionsNotifications()->count()}}</span>
                                @endif
                                <i class="btn btn-primary fa fa-comments fa-lg" aria-hidden="true"></i>
                            </a>
                            <a href="{{ route('requirements.show',['requirement'=>$requirement->id,'type'=>$text]) }}" title="View files" class="notify-container">
                                @if($requirement->newFilesNotifications()->count()>0)
                                    <span class="notify-bubble">{{$requirement->newFilesNotifications()->count()}}</span>
                                @endif
                                <i class="btn btn-primary fa fa-files-o fa-lg" aria-hidden="true"></i>
                            </a>
                            @hasanyrole('admin')
                            {{Form::open(array('route'=>array('notifications.destroy',$requirement->id,'type'=>$text),'method'=>'DELETE','style'=>'display:inline;border:none;margin:0;padding:0;'))}}
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

    </div>
    {{--<div class="card-footer small text-muted">Updated today at 11:59 PM</div> --}}
</div>
@stop

@section('script')
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
    $(document).ready(function() {
        $('.dataTable').each(function(){
            $(this).DataTable();
        });
        $('#project').change( function() {
            $('.dataTable').each(function(){
                $(this).DataTable().draw();
            });
        } );
    } );

@stop