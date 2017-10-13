@extends('layout.app')
@section('content')

<!-- DataTables Card-->
<div class="row">
    <div class="col-md-4">
        <a class="btn btn-primary" href="{{route('users.create')}}">Create new user</a>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
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
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at->toFormattedDateString()}}</td>
                        <td>{{$user->roles->first()->display_name}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{--<div class="card-footer small text-muted">Updated today at 11:59 PM</div> --}}
</div>
@stop