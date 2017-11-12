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


<div class="form-group col-md-6">
    Company - Dreamers & Heroes Unipessoal, LDA <br>
    Address: Rua Ary dos Santos nº5 -2º Esquerdo 2925-061 Azeitão<br>
    VAT ID: 513805168<br>
    IBAN: PT50 0035 0275 00029494830 52<br>
    BIC SWIFT: CGDIPTPL<br>
</div>