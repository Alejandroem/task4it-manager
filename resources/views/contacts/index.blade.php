@extends('layout.app')
@section('content')
<div class="card mb-3">
    <div class="card-header">
        <a class="btn btn-primary pull-right" href="{{route('contacts.create')}}">Create new contact</a>
        <i class="fa fa-table"></i> Contacts </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>
                                Country
                            </th>
                            <th>
                                City
                            </th>
                            <th>
                                Website
                            </th>
                            <th>
                                Company Name
                            </th>
                            <th>
                                Contact Type
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Phone
                            </th>
                            <th>
                                Open position
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Observations
                            </th>
                            <th>
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <hbody>
                        @foreach($contacts as $contact)
                            <tr>
                                <td>
                                    {{$contact->city->country->name}}
                                </td>                        
                                <td>
                                    {{$contact->city->name}}
                                </td>                        
                                <td>
                                    {{$contact->website}}
                                </td>                        
                                <td>
                                    {{$contact->company_name}}
                                </td>                        
                                <td>
                                    {{$contact->contact_type->name}}
                                </td>                        
                                <td>
                                    {{$contact->email}}
                                </td>                        
                                <td>
                                    {{$contact->phone}}
                                </td>                        
                                <td>
                                    {{$contact->open_position}}
                                </td>                        
                                <td style="color : {{$contact->status->font_color}}; background-color: {{$contact->status->background_color}}">
                                    {{$contact->status->name}}
                                </td>
                                <td>
                                    {{$contact->observations}}
                                </td>                        
                                <td>
                                    <a href="{{ route('contacts.edit',$contact->id) }}" title="Edit contact">
                                        <i class="btn btn-primary fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>
                                    </a>
                                    {{Form::open(array('route'=>array('contacts.destroy',$contact),'method'=>'DELETE','style'=>'display:inline;border:none;margin:0;padding:0;'))}}
                                        {{csrf_field()}}
                                        <button style="background:none!important;border:none;padding:0!important;border-bottom:1px solid #444; " title="Delete contact">
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
    </div>
</div>
@stop