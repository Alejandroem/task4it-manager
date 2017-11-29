<div class="row">
    <div class="col-md-4 form-group">
        {{Form::text('position',null,['id'=>'positions[]', 'name'=>'positions[]','class' => 'form-control member-position'])}}
    </div>
    <div class="col-md-4 form-group">
        {{Form::text('name',null,['id'=>'names[]', 'name'=>'names[]','class' => 'form-control member-name'])}}
    </div>
    <div class="col-md-4 form-group">
        <button type="button" class="add btn btn-primary" data-class="team">+</button>
        <button type="button" class="del btn btn-primary">-</button>
    </div>
</div>