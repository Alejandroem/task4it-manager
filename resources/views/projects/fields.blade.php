<div class="form-group">
    {{Form::label('name', 'Name:')}} 
    {{Form::text('name',null,['class' => 'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('description', 'Description:')}} 
    {{Form::textarea('description',null,['class' => 'form-control'])}}
</div>
@if($project->users->count()>0)
<div class="form-group">
    {!! Form::checkboxes('users',$project->users->pluck('name','id')) !!}
</div>
@endif

<div class="form-group">
    {{Form::label('budget','Budget:')}}
    {{Form::number('budget',null,['class'=>'form-control','min'=>0,'step'=>'any' ])}}
</div>