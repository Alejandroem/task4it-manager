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
                        <td>{{$user->roles->first()? $user->roles->first()->display_name :""}}
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
                            
                            @if(Auth::user()->hasRole('admin')&&config('app.super_user')!=$user->email)
                                {{Form::open(array('class'=>'float-right','route'=>array('users.destroy',$user->id),'method'=>'DELETE','style'=>'display:inline;border:none;margin:0;padding:0;'))}}
                                    {{csrf_field()}}
                                    <button style="background:none!important;border:none;padding:0!important;border-bottom:1px solid #444; " title="Delete user">
                                        <i class="btn btn-danger fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                {{Form::close()}}
                                @if(Auth::user()->email == config('app.super_user'))
                                    <button data-user="{{$user->id}}" class="reset-password float-right" style="background:none!important;border:none;padding:0!important;border-bottom:1px solid #444; " title="Reset password">
                                        <i class="btn btn-danger fa fa-edit" aria-hidden="true"></i>
                                    </button>
                                @endif
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

@section('script')
 $('.reset-password').click(function(){
     var id = $(this).data('user');
     swal({
            title: 'Enter the new password:',
            input: 'text',
            showCancelButton: true,
            confirmButtonText: 'Submit',
            showLoaderOnConfirm: true,
            preConfirm: function (password) {
                 return new Promise(function (resolve, reject) {
                    $.ajax({
                        url: "{{ URL::to('users') }}/"+id,
                        data:{'_token':'{{ csrf_token() }}','password':password,'superuser':true},
                        type: "PUT",
                        success: function(response) {
                            resolve();
                        },
                        error: function(xhr) {
                            reject("Something went wrong");
                        }
                    });
                });
            },
            allowOutsideClick: false
        }).then(function (name) {
            swal({
                type: 'success',
                title: 'The password has been reseted!'
            });
        });
 });
@stop