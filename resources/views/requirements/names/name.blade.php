<div class="col-md-4" id="{{$name->id}}">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-{{$name->id}}" aria-expanded="true" aria-controls="collapseOne">
                    {{$name->name}} 
                    <button class="btn btn-danger pull-right delete" data-parent="{{$name->id}}">-</button>
                    <button class="btn btn-primary add pull-right" data-parent="{{$name->id}}">Add SubReq</button>
                </button>
            </h5>
        </div>
        
        <div id="collapse-{{$name->id}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body" id="subrequirements-{{$name->id}}">
                @foreach($name->subrequirements as $subrequirement)
                <div class="form-group" id="{{$subrequirement->id}}" >
                    <div class="row">
                        <div class="col-md-5">
                            {!! Form::label("req-".$subrequirement->id, $subrequirement->name, ['class'=>'form-control']) !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::checkbox("req-".$subrequirement->id, null, $budget && $budget->requirements->contains($subrequirement->id)?true: false, ['class'=>'form-control']) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::number("req-".$subrequirement->id.'-amount', $budget && $budget->requirements->where('id',$subrequirement->id)->first()?$budget->requirements->where('id',$subrequirement->id)->first()->pivot->rate: $subrequirement->base_rate, ['class'=>'form-control','min'=>'0']) !!}
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-danger delete"  data-parent="{{$subrequirement->id}}">-</button>
                        </div>
                    </div>
                </div>
                @endforeach 
            </div>
        </div>
    </div>
</div>