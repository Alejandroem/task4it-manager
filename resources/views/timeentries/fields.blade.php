<div class="row">
    <div class="col-md-8 form-group">
        <div class="row my-2">
            <div class="col-md-12">
                {{Form::label('project_id', 'Select a project:')}} 
                {{Form::select('project_id', $projects,null,['placeholder'=>'Select a project...','class' => 'form-control'])}}
            </div>
        </div>
        <div class="row my-2">
        <div class="col-md-4 ">
                {{Form::label('hours', 'Hours:')}}
                {{Form::number('hours',null,['class' => 'form-control','min'=>'1','step'=>'any','required'=>'true'])}}
            </div>
            <div class="col-md-4 ">
                {{Form::label('minutes', 'Minutes:')}}
                {{Form::number('minutes',null,['class' => 'form-control','min'=>'1','max'=>'59','step'=>'any','required'=>'true'])}}
            </div>
            <div class="col-md-4 ">
                {{Form::label('rate', 'Enter your hourly rate:')}}
                {{Form::number('hourly_rate',null,['class' => 'form-control','min'=>'1','step'=>'any','required'=>'true'])}}
            </div>
        </div>
    </div>
</div>
