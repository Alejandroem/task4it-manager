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
                                            </tr>
                                        </thead>
                                        <hbody>
                                            @foreach($countries as $country)
                                            <tr>
                                                <td>
                                                    {{$country->name}}
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
                                            </tr>
                                        </thead>
                                        <hbody>
                                            @foreach($types as $type)
                                            <tr>
                                                <td>
                                                    {{$type->name}}
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