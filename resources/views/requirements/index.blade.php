@extends('layout.app')
@section('content')
<div class="card mb-3">
    <div class="card-header">
        
        <a class="btn btn-primary pull-right @if(Auth::user()->hasRole('client')&& !Auth::user()->can('create')) disabled @endif" href="{{route('requirements.create',['type'=>$text])}}">Create new {{$text}}</a>

        <i class="fa fa-table"></i> {{$text}} </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
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
                    @foreach($requirements as $requirement)
                    <tr>
                        <td>{{$requirement->project->name}}</td>
                        <td>{{$requirement->title}}</td>
                        <td>{{$requirement->description}}</td>
                        
                        
                        @if($requirement->rate==null)
                            @if(Auth::user()->hasAnyRole('developer'))
                            <td>
                                {{Form::model($requirement, array('route' => array('requirements.updateRate', 'requirement'=>$requirement->id,'type'=>$text),'method'=>'POST'))}}
                                <div class="row">
                                    <div class="col">
                                        {{Form::number('rate', null,['class' => 'form-control'])}}
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
                        @if($requirement->percentage==null)
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
                        @if($requirement->percentage==null||$requirement->rate==null)
                            Not available yet
                        @else
                            {{number_format($requirement->rate+$requirement->percentage + $requirement->rate,2)}}€
                        @endif
                        @endhasanyrole
                        </td>
                        <td>
                        @if($requirement->status==1)
                            @if($requirement->percentage!=null&&$requirement->rate!=null)
                                @if(Auth::user()->hasRole('client'))
                                     {{Form::open(array('route' => array('requirements.status', 'requirement'=>$requirement->id,'status'=>2,'type'=>$text),'method'=>'POST'))}}
                                        {{Form::submit('Approve',['class'=>'btn btn-primary'])}}
                                    {{Form::close()}}
                                @else
                                    <div class="alert alert-primary" role="alert">
                                        Created
                                    </div>
                                @endif
                            @endif
                        @elseif($requirement->status==2)
                        <div class="alert alert-secondary" role="alert">
                            ongoing
                        </div>
                        @elseif($requirement->status==3)
                        <div class="alert alert-success" role="alert">
                            Completed
                        </div>balance
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
                                Pendient
                                </div>
                            @endif
                        </td>
                        @endhasanyrole
                        <td>{{$requirement->due_to->toFormattedDateString()}}</td>
                        <td>{{$requirement->created_at->toFormattedDateString()}}</td>
                        <td>
                        <div class="row">
                            <a href="{{route('requirements.questions.index',['bug'=>$requirement->id])}}">
                                <i class="btn btn-primary fa fa-comments fa-lg" aria-hidden="true"></i>
                            </a>
                            <a href="{{ route('requirements.show',['requirement'=>$requirement->id,'type'=>$text]) }}" title="View files">
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