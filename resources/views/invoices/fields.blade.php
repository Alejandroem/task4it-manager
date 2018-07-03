<div class="row">
    <div class="col-md-4 form-group">
        <div class="row my-2">
            <div class="col-md-12">
                {{Form::label('project', 'Select a project:')}} 
                {{Form::select('project', $projects,null,['placeholder'=>'Select a project...','class' => 'form-control'])}}
            </div>
            <div class="form-group col-md-12">
                {{Form::label('date', 'Date:')}} 
                <input class="datepicker form-control" name="date" id="date">
            </div>
            <div class="col-md-12">
                {{Form::label('amount', 'Enter the amount of your payment:')}}
                {{Form::number('amount',null,['class' => 'form-control','min'=>'1','step'=>'any','required'=>'true'])}}
            </div>
        </div>
    </div>
    <div class="col-md-4 form-group">
        {{Form::label('file', 'Attach your file:')}}
        {{Form::file('file',['class' => 'form-control','required'=>'true'])}}
    </div>
</div>
