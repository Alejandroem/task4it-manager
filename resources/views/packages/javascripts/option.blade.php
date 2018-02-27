`
<div class="card border-secondary mb-3" id="option-`+id+`">
    <div class="card-header bg-transparent border-secondary">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-option-`+id+`" aria-expanded="true" aria-controls="collapseOne">
           `+name+`
            <button class="btn btn-danger pull-right delete" data-id="`+id+`" data-type="2">-</button>
            <button class="btn btn-primary add pull-right" data-parent="`+id+`" data-type="3">Add Value</button>
            <button class="btn btn-secondary pull-right multiple" data-multiple="false" data-parent="`+id+`">Multiple</button>
        </button>
    </div>
    <div id="collapse-option-`+id+`" class=" collapse show card-body text-secondary">
        <div id="values-`+id+`">
            
        </div>
    </div>
</div>
`