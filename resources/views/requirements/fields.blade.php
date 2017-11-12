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
                {{Form::label('project', 'Select a project:')}} 
                {{Form::select('project', $projects,null,['placeholder'=>'Select a project...','class' => 'form-control'])}}
        </div>
        <div class="form-group">
                {{Form::label('priority', 'Priority:')}}
                <select class="form-control" name="priority" id="priority">
                    <option value="0">Low</option>
                    <option value="1">Medium</option>
                    <option value="2">High</option>
                </select>
        </div>
        <div class="form-group">
            {{Form::label('due_to', 'Due to:')}} 
            <input class="datepicker form-control" name="due_to" id="due_to">
        </div>
    </div>
</div>
