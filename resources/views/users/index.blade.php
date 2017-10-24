@extends('layout.app')
@section('content')
<div class="card mb-3">
    <div class="card-header">
        <a class="btn btn-primary pull-right" href="{{route('users.create')}}">Create new user</a>
        <i class="fa fa-table"></i> Users </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created at</th>
                        <th>Roles</th>
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
                    @foreach($users as $user)
                    <tr>
                        <td>
                            {{$user->name}}
                        </td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at->toFormattedDateString()}}</td>
                        <td>{{$user->roles->first()->display_name}}
                            @if($user->hasRole('client'))
                                &nbsp
                                &nbsp
                                &nbsp
                                @if($user->can('create'))
                                    <form class="float-right" action="{{ route('users.endis',['user'=>$user->id,'value'=>0]) }}" method="POST">
                                        {{csrf_field()}}
                                        <button style="background:none!important;border:none;padding:0!important;border-bottom:1px solid #444; " title="Disable user">
                                            <i class="btn btn-primary fa fa-check-square" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                @else
                                    <form class="float-right" action="{{ route('users.endis',['user'=>$user->id,'value'=>1]) }}" method="POST">
                                        {{csrf_field()}}
                                        <button style="background:none!important;border:none;padding:0!important;border-bottom:1px solid #444; " title="Enable user">
                                            <i class="btn btn-primary fa fa-square" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                @endif
                            @endif
                            @if(Auth::user()->hasRole('admin'))
                                {{Form::open(array('route'=>array('users.destroy',$user->id),'method'=>'DELETE'))}}
                                    {{csrf_field()}}
                                    <button style="background:none!important;border:none;padding:0!important;border-bottom:1px solid #444; " title="Delete user">
                                        <i class="btn btn-danger fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                {{Form::close()}}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{--<div class="card-footer small text-muted">Updated today at 11:59 PM</div> --}}
</div>
@stop