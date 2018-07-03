<div class="row">
    <div class="col-md-8 form-group">
        <div class="row my-2">
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
            <div class="col-md-6">
                {{Form::label('description', 'Enter a brief description:')}}
                {{Form::text('description',null,['class' => 'form-control','required'=>'true'])}}
            </div>
        </div>
    </div>
</div>
