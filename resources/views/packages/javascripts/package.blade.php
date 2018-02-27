`
<div class="col-md-4" id="package-`+id+`">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-`+id+`" aria-expanded="true" aria-controls="collapseOne">
                    `+name+` 
                    <button class="btn btn-danger pull-right delete" data-id="`+id+`" data-type="1">-</button>
                    <button class="btn btn-primary add pull-right" data-parent="`+id+`" data-type="2">Add Option</button>
                </button>
            </h5>
        </div>
        
        <div id="collapse-`+id+`" class="collapse show" aria-labelledby="headingOne">
            <div class="card-body" id="options-`+id+`">
                
            </div>
        </div>
        <div class="card-footer text-muted">
            Refresh to see package short link.
        </div>
    </div>
</div>
`