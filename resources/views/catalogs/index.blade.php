@extends('layout.app')
@section('content')
<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-table"></i> Catalogues </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <a class="btn btn-sm btn-primary pull-right" href="{{route('countries.create')}}">New</a>
                                <h3>Country Catalogue</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                <table class="table table-bordered datatable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Name
                                                </th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <hbody>
                                            @foreach($countries as $country)
                                            <tr>
                                                <td>
                                                    {{$country->name}}
                                                </td>
                                                <td>
                                                {{Form::open(array('route'=>array('countries.destroy',$country),'method'=>'DELETE','style'=>'display:inline;border:none;margin:0;padding:0;'))}}
                                                    {{csrf_field()}}
                                                    <button style="background:none!important;border:none;padding:0!important;border-bottom:1px solid #444; " title="Delete country">
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
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <a class="btn btn-sm btn-primary pull-right" href="{{route('cities.create')}}">New</a>
                                <h3>Cities Catalogue</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered datatable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Country
                                                </th>
                                                <th>
                                                    Name
                                                </th>
                                                <th>
                                                    
                                                </th>
                                            </tr>
                                        </thead>
                                        <hbody>
                                            @foreach($cities as $city)
                                            <tr>
                                                <td>
                                                    {{$city->country->name}}
                                                </td>
                                                <td>
                                                    {{$city->name}}
                                                </td>
                                                <td>
                                                {{Form::open(array('route'=>array('cities.destroy',$city),'method'=>'DELETE','style'=>'display:inline;border:none;margin:0;padding:0;'))}}
                                                    {{csrf_field()}}
                                                    <button style="background:none!important;border:none;padding:0!important;border-bottom:1px solid #444; " title="Delete city">
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
                </div>
                <div class="row my-5">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <a class="btn btn-sm btn-primary pull-right" href="{{route('status.create')}}">New</a>
                                <h3>Contact Status Catalogue</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                <table class="table table-bordered datatable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Name
                                                </th>
                                                <th>
                                                    Font-Color
                                                </th>
                                                <th>
                                                    Background
                                                </th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <hbody>
                                            @foreach($status as $singleStatus)
                                            <tr>
                                                <td style="color: {{$singleStatus->font_color}}; background-color:{{$singleStatus->background_color}} ;">
                                                    {{$singleStatus->name}}
                                                </td>
                                                <td style="background-color:{{$singleStatus->font_color}}">
                                                    
                                                </td>
                                                <td style="background-color:{{$singleStatus->background_color}}">
                                                    
                                                </td>
                                                <td>
                                                {{Form::open(array('route'=>array('status.destroy',$singleStatus),'method'=>'DELETE','style'=>'display:inline;border:none;margin:0;padding:0;'))}}
                                                    {{csrf_field()}}
                                                    <button style="background:none!important;border:none;padding:0!important;border-bottom:1px solid #444; " title="Delete status">
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
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <a class="btn btn-sm btn-primary pull-right" href="{{route('types.create')}}">New</a>
                                <h3>Contact Types</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered datatable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Name
                                                </th>
                                                <th>
                                                    
                                                </th>
                                            </tr>
                                        </thead>
                                        <hbody>
                                            @foreach($types as $type)
                                            <tr>
                                                <td>
                                                    {{$type->name}}
                                                </td>
                                                <td>
                                                    {{Form::open(array('route'=>array('types.destroy',$type),'method'=>'DELETE','style'=>'display:inline;border:none;margin:0;padding:0;'))}}
                                                        {{csrf_field()}}
                                                        <button style="background:none!important;border:none;padding:0!important;border-bottom:1px solid #444; " title="Delete Type">
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
                </div>
            </div>
        </div>
        {{--<div class="card-footer small text-muted">Updated today at 11:59 PM</div> --}}
    </div>
</div>
@stop