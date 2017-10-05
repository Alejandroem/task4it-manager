<div class="row">
    <div class="col-md-6">
        <input name="type" id="type" value="{{$text}}" hidden>
        <div class="form-group">
            {{Form::label('title', 'Title:')}} 
            {{Form::text('title',null,['class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('description', 'Description:')}} 
            {{Form::textarea('description',null,['class' => 'form-control'])}}
        </div>
        
    </div>
    <div class="col-md-4">
        <div class="form-group">
                {{Form::label('priority', 'Priority: (1->100)')}} 
                {{Form::number('priority', null,['min'=>1,'max'=>100,'class' => 'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('due_to', 'Due to:')}} 
            <input class="datepicker form-control" name="due_to" id="due_to">
        </div>
    </div>
</div>
