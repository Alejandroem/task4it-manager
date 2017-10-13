<div class="form-group">
    {{Form::label('username', 'User Name:')}}
    {{Form::text('username',null,['class' => 'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('email', 'email:')}}
    {{Form::email('email',null,['class' => 'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('password', 'Password:')}}
    {{Form::password('password',['class' => 'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('role', 'Roles:')}}
    {{Form::select('role',$roles,null, ['class' => 'form-control'])}}
</div>