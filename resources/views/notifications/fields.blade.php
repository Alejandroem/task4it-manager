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
        {{Form::label('priority','Select the message type:')}}
        <div class="alert alert-primary" role="alert">
            <strong>Title</strong> Message of the notification!!
        </div>
        <div class="alert alert-success" role="alert">
            <strong>Title</strong> Message of the notification!!
        </div>
        <div class="alert alert-danger" role="alert">
            <strong>Title</strong> Message of the notification!!
        </div>
        <div class="alert alert-warning" role="alert">
            <strong>Title</strong> Message of the notification!!
        </div>
    </div>
</div>