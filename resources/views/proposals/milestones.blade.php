<div class="row">
    <div class="col-md-10 form-group">
        {{Form::text('position',isset($milestone)?$milestone:null,['id'=>'milestones[]', 'name'=>'milestones[]','class' => 'form-control milestone-description'])}}
    </div>
    <div class="col-md-2 form-group">
        <button type="button" class="add btn btn-primary" data-class="milestones">+</button>
        <button type="button" class="del btn btn-primary">-</button>
    </div>
</div>