@extends('layout.app')
@section('content')
<div class="card mb-3">
    <div class="card-header">
        <a class="btn btn-primary pull-right" href="{{route('contacts.create')}}">Create new contact</a>
        <i class="fa fa-table"></i> Contacts </div>
        <div class="card-body">
            <select name="all_cities" id="all_cities" hidden>               
                @foreach($cities as $city)
                    <option class="all_cities" data-country="{{$city->country_id}}" value="{{$city->id}}" >{{$city->name}}</option>   
                @endforeach
            </select>
            <table border="0" cellspacing="5" cellpadding="5" class="ml-2 my-2">
                <tbody>
                <form action="{{ route('contacts.index',['country_sel'=>$country_sel]) }}" method="GET">
                    <tr>
                        <td>Country:</td>
                        <td>
                            
                                <select class="custom-select" id="country_sel" name="country_sel" >
                                    <option value="">Select a country</option>
                                    @foreach($countries as $key => $country)
                                    <option @if($country_sel==$key) selected @endif value="{{$key}}">{{$country}}</option>
                                    @endforeach
                                </select>
                        </td>
                        <td>City:</td>
                        <td>
                                <select class="custom-select" id="city_sel" name="city_sel" >
                                    <option value="">Select a City</option>
                                    @foreach($cities as  $city)
                                    <option data-country="{{$city->country_id}}" @if($city_sel==$city->id) selected @endif value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>

                        </td>
                        <td>
                        <button class="btn btn-primary" type="submit">Filter</button>
                        </td> 
                    </tr>
                    </form>
                </tbody>
            </table>
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

@section('script')
const NONE = "";
    $('#country_sel').change(function(){
        var selected = $(this).find(":selected");
        var filtered_cities;
        if(selected.val().localeCompare(NONE)==0){
            filtered_cities = $("#all_cities option");
        }else{
            filtered_cities = $('#all_cities [data-country="'+selected.val()+'"]');
        }
        $('#city_sel').html(filtered_cities.clone());
        $('#city_sel').prepend('<option value="">Select a city</option>').val('');
    });
    $('#city_sel').change(function(){
        
        $('#country_sel').val($(this).find(":selected").data('country'));
        var selectedCity= $(this).find(':selected');

        var selected = $('#country_sel').find(":selected");
        var filtered_cities;
        if(selected.val().localeCompare(NONE)==0){
            filtered_cities = $("#all_cities option");
        }else{
            filtered_cities = $('#all_cities [data-country="'+selected.val()+'"]');
        }
        $('#city_sel').html(filtered_cities.clone());
        $('#city_sel').val(selectedCity.val());
    });
@stop