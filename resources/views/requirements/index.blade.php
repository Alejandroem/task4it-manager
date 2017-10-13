@extends('layout.app')
@section('content')

<!-- DataTables Card-->
<div class="row">
    <div class="col-md-4">
        <a class="btn btn-primary" href="{{route('requirements.create',['type'=>$text])}}">Create new {{$text}}</a>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-table"></i> {{$text}} </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Title</th>
                        <th>Description</th>
                        
                        <th>Rate</th>
                        
                        @hasanyrole('admin')
                        <th>%</th>
                        @endhasanyrole
                        @hasanyrole('admin|client') 
                        <th>Total</th>
                        @endhasanyrole
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Payed</th>
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
                        
                        <td>
                        @if($requirement->rate==null)
                            @if(Auth::user()->hasAnyRole('developer'))
                                {{Form::model($requirement, array('route' => array('requirements.updateRate', $requirement->id),'method'=>'POST'))}}
                                <div class="row">
                                    <div class="col">
                                    <input name="type" id="type" value="{{$text}}" hidden>
                                        {{Form::number('rate', null,['min'=>1,'max'=>100,'class' => 'form-control'])}}
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary"><i class="fa fa-check-circle-o" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                                {{Form::close()}}
                            @else
                                Waiting for developer response
                            @endif
                        @else
                            $ {{number_format($requirement->rate,2)}}
                        @endif
                        </td>
                        
                        @hasanyrole('admin')
                        <td>
                        @if($requirement->percentage==null)
                            Waiting for admin response
                        @else
                            {{$requirement->rate}}
                        @endif
                        </td>
                        @endhasanyrole

                        @hasanyrole('admin|client')    
                        <td>
                        @if($requirement->percentage==null||$requirement->rate==null)
                            Not available yet
                        @else
                            {{$requirement->rate*$requirement->percentage + $requirement->rate}}
                        @endif
                        @endhasanyrole
                        </td>
                        <td>
                        @if($requirement->status==1)
                        <div class="alert alert-primary" role="alert">
                            Created
                        </div>
                        @elseif($requirement->status==2)
                        <div class="alert alert-secondary" role="alert">
                            ongoing
                        </div>
                        @elseif($requirement->status==3)
                        <div class="alert alert-success" role="alert">
                            Completed
                        </div>
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
                        <td>{{$requirement->priority}}</td>
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
                        <td>{{$requirement->due_to->toFormattedDateString()}}</td>
                        <td>{{$requirement->created_at->toFormattedDateString()}}</td>
                        <td>
                            <a href="{{route('requirements.questions.index',['bug'=>$requirement->id])}}">
                                <i class="btn btn-primary fa fa-comments fa-lg" aria-hidden="true"></i>
                            </a>
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