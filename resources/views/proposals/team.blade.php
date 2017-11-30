<div class="row">
    <div class="col-md-4 form-group">
        {{Form::label('Position name:')}}
        {{Form::text('position',isset($position)?$position:null,['id'=>'positions[]', 'name'=>'positions[]','class' => 'form-control member-position'])}}
        <small id="positionHelp" class="form-text text-muted">Web developer.</small>
    </div>
    <div class="col-md-4 form-group">
        {{Form::label('Member name:')}}
        {{Form::text('name',isset($name)?$name:null,['id'=>'names[]', 'name'=>'names[]','class' => 'form-control member-name'])}}
        <small id="nameHelp" class="form-text text-muted">Alejandro Enriquez.</small>
    </div>
    <div class="col-md-4 form-group">
        <button type="button" class="add btn btn-primary" data-class="team">+</button>
        <button type="button" class="del btn btn-primary">-</button>
    </div>
</div>