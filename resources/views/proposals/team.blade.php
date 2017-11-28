<div class="col-md-12 row">
    <div class="col-md-1 form-group">
        {{Form::label('number', '#1:',['class'=>'member-number','data-member'=>'1'])}}
    </div>
    <div class="col-md-4 form-group">
        {{Form::text('position',null,['class' => 'form-control member-position','data-member'=>'1'])}}
    </div>
    <div class="col-md-4 form-group">
        {{Form::text('name',null,['class' => 'form-control member-name','data-member'=>'1'])}}
    </div>
</div>