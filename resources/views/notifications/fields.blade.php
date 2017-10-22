<div class="col-md-6">
    <div class="form-group">
        {{Form::label('title', 'Notification title:')}}
        {{Form::text('title',null,['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{Form::label('message', 'Notification body:')}}
        {{Form::text('message',null,['class' => 'form-control'])}}
    </div>
    <div class="form-group">
        {!! Form::checkboxes('users',$users) !!}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <input type="text" name="priority" id="priority" hidden value="0">
        {{Form::label('priority','Select the message type:')}}
        <div data-value="0" class="alert alert-primary" role="alert">
            <strong>Title</strong> Message of the notification!!
        </div>
        <div data-value="1" class="alert alert-success" role="alert">
            <strong>Title</strong> Message of the notification!!
        </div>
        <div data-value="2" class="alert alert-danger" role="alert">
            <strong>Title</strong> Message of the notification!!
        </div>
        <div data-value="3" class="alert alert-warning" role="alert">
            <strong>Title</strong> Message of the notification!!
        </div>
    </div>
</div>