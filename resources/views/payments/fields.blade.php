<div class="form-group col-md-6">
    {{Form::label('description','Add a payment description: ')}}
    {{Form::textarea('description',null,['class' => 'form-control'])}}
</div>

<div class="form-group col-md-6">
    {{Form::label('file','Upload a payment file: ')}}
    <br>
    <label class="custom-file">
        <input type="file" id="file" name="file" class="custom-file-input" required>
        <span class="custom-file-control"></span>
    </label>
</div>

<div class="form-group col-md-6">
    {{Form::label('amount', 'Enter the amount of your payment:')}}
    {{Form::number('amount',null,['class' => 'form-control','min'=>'1','step'=>'any'])}}
</div>


