@extends('layout.app')
@section('content')
<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-table"></i> Enquires </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>
                                Enquire First Name
                            </th>
                            <th>
                                Enquire Last Name
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Created at
                            </th>
                            <th>
                                Amount
                            </th>
                            <th>
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <hbody>
                        @foreach($enquires as $enquire)
                        <tr>
                            <td>
                                {{$enquire->first_name}}
                            </td>
                            <td>
                                {{$enquire->last_name}}
                            </td>
                            <td>
                                {{$enquire->email}}
                            </td>
                            <td>
                                {{$enquire->created_at->toFormattedDateString()}}
                            </td>
                            <td>
                                ${{number_format($enquire->amount(),2)}}
                            </td>
                            <td>
                                <a href="{{ route('enquires.show',['id'=>$enquire->id]) }}" title="Show enquire">
                                    <i class="btn btn-primary fa fa-info-circle fa-lg" aria-hidden="true"></i>
                                </a>
                                {{Form::open(array('route'=>array('enquires.destroy',$enquire->id),'method'=>'DELETE','style'=>'display:inline;border:none;margin:0;padding:0;'))}}
                                    {{csrf_field()}}
                                    <button style="background:none!important;border:none;padding:0!important;border-bottom:1px solid #444; " title="Delete project">
                                        <i class="btn btn-danger fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                {{Form::close()}}
                            </td>
                        </tr>
                        @endforeach
                    </hbody>
                </table>
            </div>
        </div>
        {{--<div class="card-footer small text-muted">Updated today at 11:59 PM</div> --}}
    </div>
</div>
@stop