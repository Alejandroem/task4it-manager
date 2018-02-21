<div class="col-md-4" id="{{$package->id}}">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-{{$package->id}}" aria-expanded="true" aria-controls="collapseOne">
                    {{$package->name}} 
                    <button class="btn btn-danger pull-right delete" data-parent="{{$package->id}}">-</button>
                    <button class="btn btn-primary add pull-right" data-parent="{{$package->id}}">Add Option</button>
                </button>
            </h5>
        </div>
        
        <div id="collapse-{{$package->id}}" class="collapse show" aria-labelledby="headingOne">
            <div class="card-body" id="option-{{$package->id}}">
                @foreach($package->options as $option)
                <div class="form-group" id="{{$option->id}}" >
                    <div class="card border-secondary mb-3" >
                        <div class="card-header bg-transparent border-secondary">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-option-{{$package->id}}" aria-expanded="true" aria-controls="collapseOne">
                                {{$option->subject}}
                                <button class="btn btn-danger pull-right delete" data-parent="{{$package->id}}">-</button>
                                <button class="btn btn-primary add pull-right" data-parent="{{$option->id}}">Add Value</button>
                            </button>
                        </div>
                        <div id="collapse-option-{{$package->id}}" class=" collapse show card-body text-secondary">
                            @foreach($option->values as $value)
                                <div class="row">
                                    <div class="col-md-5">
                                        {!! Form::label($value->name, $value->name, ['class'=>'form-control']) !!}
                                    </div>
                                    <div class="col-md-5">
                                        {!! Form::label($value->value, $value->value, ['class'=>'form-control']) !!}
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn btn-danger delete"  data-parent="{{$value->id}}">-</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach 
            </div>
        </div>
    </div>
</div>