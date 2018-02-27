<div class="col-md-4" id="package-{{$package->id}}">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-{{$package->id}}" aria-expanded="true" aria-controls="collapseOne">
                    {{$package->name}} 
                    <button class="btn btn-danger pull-right delete" data-id="{{$package->id}}" data-type="1">-</button>
                    <button class="btn btn-primary add pull-right" data-parent="{{$package->id}}" data-type="2">Add Option</button>
                </button>
            </h5>
        </div>
        
        <div id="collapse-{{$package->id}}" class="collapse show" aria-labelledby="headingOne">
            <div class="card-body" id="options-{{$package->id}}">
                @foreach($package->options as $option)
                    <div class="card border-secondary mb-3" id="option-{{$option->id}}">
                        <div class="card-header bg-transparent border-secondary">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-option-{{$option->id}}" aria-expanded="true" aria-controls="collapseOne">
                                {{$option->subject}}
                                <button class="btn btn-danger pull-right delete" data-id="{{$package->id}}" data-type="2">-</button>
                                <button class="btn btn-primary add pull-right" data-parent="{{$option->id}}" data-type="3">Add Value</button>
                            </button>
                        </div>
                        <div id="collapse-option-{{$option->id}}" class=" collapse show card-body text-secondary">
                            <div id="values-{{$option->id}}">
                                @foreach($option->values as $value)
                                    <div class="row" id="value-{{$value->id}}">
                                        <div class="col-md-5">
                                            {!! Form::label($value->name, $value->name, ['class'=>'form-control']) !!}
                                        </div>
                                        <div class="col-md-5">
                                            {!! Form::label($value->value, $value->value, ['class'=>'form-control value','id'=>'option-value-'.$value->id,'data-idvalue'=>$value->id]) !!}
                                        </div>
                                        <div class="col-md-1">
                                            <button class="btn btn-danger delete"  data-id="{{$value->id}}" data-type="3">-</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach 
            </div>
        </div>
        <div class="card-footer text-muted">
            <a target="_blank" class="btn btn-primary pull-right btn-sm" href="{{route('packages.show',$package->id)}}">Go to package</a>
        </div>
    </div>
</div>