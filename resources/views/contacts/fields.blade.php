<div class="row">
    <div class="col-md-4 form-group">
        <div class="row">
            <div class="col-md-11">
                <div class="row">
                    <div class="col-md-10">
                        {{Form::label('country', 'Country:')}}
                    </div>
                    <div class="col-md-2">
                       {{--  @hasanyrole('admin')
                        <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="">
                            <i class="fa fa-plus"></i>
                        </button>
                        @endhasanyrole --}}
                    </div>
                </div>
                {{ Form::select('country', $countries, isset($contact)? $contact->city->country->id:null, ['id'=>'countries','placeholder' => 'Pick a country...','class'=>'form-control','required'=>'true']) }}
                <!-- Trigger the modal with a button -->
            </div>
        </div>
        <div class="row my-2">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-10">
                        {{Form::label('city', 'City:')}}
                    </div>
                    <div class="col-md-2">
                       {{--  @hasanyrole('admin')
                        <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="">
                            <i class="fa fa-plus"></i>
                        </button>
                        @endhasanyrole --}}
                    </div>
                </div>
                <select name="all_cities" id="all_cities" hidden>               
                    @foreach($cities as $city)
                        <option class="all_cities" data-country="{{$city->country_id}}" value="{{$city->id}}" >{{$city->name}}</option>   
                    @endforeach
                </select>
                <select name="city" id="city" class="form-control" placeholder= "Pick a status..." required >               
                    <option value="null">Pick a city</option>
                    @foreach($cities as $city)
                        <option data-country="{{$city->country_id}}" @if( isset($contact) && $city->id == $contact->city_id)  selected @endif  value="{{$city->id}}" >{{$city->name}}</option>   
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-md-6">
                {{Form::label('website', 'WebSite:')}}
                {{ Form::text('website',isset($contact)? $contact->website:null, ['class'=>'form-control','required'=>'true']) }}
            </div>
            <div class="col-md-6">
                {{Form::label('company_name', 'Company Name:')}}
                {{ Form::text('company_name', isset($contact)? $contact->company_name:null, ['class'=>'form-control','required'=>'true']) }}
            </div>
        </div>
        <div class="row my-2">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-10">
                        {{Form::label('contact_type', 'Contact Type:')}}
                    </div>
                    <div class="col-md-2">
                      {{--   @hasanyrole('admin')
                        <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="">
                            <i class="fa fa-plus"></i>
                        </button>
                        @endhasanyrole --}}
                    </div>
                </div>
                {{ Form::select('contact_type', $types, isset($contact)? $contact->contact_type->id:null, ['placeholder' => 'Pick a type...','class'=>'form-control','required'=>'true']) }}
            </div>
        </div>
         <div class="row my-2">
            <div class="col-md-12">
                {{Form::label('email', 'Email:')}}
                {{Form::email('email',isset($contact)? $contact->email:null,['class'=>'form-control','type'=>'email','required'=>'true'])}}
            </div>
        </div>
    </div>
    <div class="col-md-4">
       
        <div class="row">
            <div class="col-md-12">
                {{Form::label('phone', 'Phone:')}}
                {{Form::number('phone',isset($contact)? $contact->phone:null,['class'=>'form-control','type'=>'email','tel'])}}
            </div>
        </div>
        <div class="row my-2">
            <div class="col-md-12">
                {{Form::label('open_position', 'Open Position:')}}
                {{Form::text('open_position',isset($contact)? $contact->open_position:null,['class'=>'form-control','type'=>'text'])}}
            </div>
        </div>
        <div class="row my-2">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-10">
                        {{Form::label('status', 'Status:')}}
                    </div>
                    <div class="col-md-2">
                        {{-- @hasanyrole('admin')
                        <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="">
                            <i class="fa fa-plus"></i>
                        </button>
                        @endhasanyrole --}}
                    </div>
                </div>
                <select @if(isset($contact)) style="background-color:{{$contact->status->background_color}}; color:{{$contact->status->font_color}} " @endif name="status" id="status" class="form-control" placeholder= "Pick a status..." required >               
                    <option value="null"  style="background-color:white; color:black">Pick a status</option>
                    @foreach($status as $singleStatus)
                        <option @if( isset($contact) && $singleStatus->id == $contact->contact_status_id)  selected @endif  value="{{$singleStatus->id}}" style="color:{{$singleStatus->font_color}}; background-color:{{$singleStatus->background_color}};">{{$singleStatus->name}}</option>   
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                {{Form::label('observations', 'Observations:')}}
                {{ Form::textarea('observations', isset($contact)? $contact->observations:null, ['class'=>'form-control']) }}
            </div>
        </div>
    </div>
</div>
