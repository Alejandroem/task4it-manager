<div class="col-md-4">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-{{$name->id}}" aria-expanded="true" aria-controls="collapseOne">
                    {{$name->name}} <button class="btn btn-primary add pull-right" data-parent="{{$name->id}}">Add SubReq</button>
                </button>
            </h5>
        </div>
        
        <div id="collapse-{{$name->id}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body" id="subrequirements-{{$name->id}}">
                @foreach($name->subrequirements as $subrequirement)
                <div class="form-group" >
                    <div class="row">
                        <div class="col-md-7">
                            {!! Form::label($subrequirement->name, $subrequirement->name, ['class'=>'form-control']) !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::checkbox($subrequirement->name, null, false, ['class'=>'form-control']) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::number($subrequirement->name.'-amount', 0, ['class'=>'form-control','min'=>'0']) !!}
                        </div>
                    </div>
                </div>
                @endforeach 
            </div>
        </div>
    </div>
</div>