<div class="form-group">
    {{Form::label('name', 'Name:')}} 
    {{Form::text('name',null,['class' => 'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('description', 'Description:')}} 
    {{Form::textarea('description',null,['class' => 'form-control'])}}
</div>
@if($project_users->count()>0)
<div class="form-group">
    {!! Form::checkboxes('users',$project_users) !!}
</div>
@endif

<div class="form-group">
    {{Form::label('budget','Budget:')}}
    {{Form::number('budget',null,['class'=>'form-control','min'=>0,'step'=>'any' ])}}
</div>
@if(isset($clients))
<div class="form-group">
    {{Form::label('charge_to','Select the user to charge the budget:')}}
    {{Form::select('charge_to',$clients,null,['class'=>'form-control'])}}
</div>
@endif