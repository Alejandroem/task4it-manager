<div class="row">
    <div class="col-md-8 form-group">
        <div class="row my-2">
            <div class="col-md-12">
                {{Form::label('project_id', 'Select a project:')}} 
                {{Form::select('project_id', $projects,null,['placeholder'=>'Select a project...','class' => 'form-control'])}}
            </div>
            <div class="form-group col-md-6">
                {{Form::label('started_at', 'Date:')}} 
                <input class="datetimepicker form-control date_timepicker_start" autocomplete="off" name="started_at" id="started_at">
            </div>
            <div class="form-group col-md-6">
                {{Form::label('ended_at', 'Date:')}} 
                <input class="datetimepicker form-control date_timepicker_end" autocomplete="off" name="ended_at" id="ended_at">
            </div>
        </div>
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4 ">
                {{Form::label('rate', 'Enter your hourly rate:')}}
                {{Form::number('hourly_rate',null,['class' => 'form-control','min'=>'1','step'=>'any','required'=>'true'])}}
            </div>
        </div>
    </div>
</div>
