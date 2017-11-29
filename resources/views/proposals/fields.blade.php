<ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="header-tab" data-toggle="tab" href="#header" role="tab" aria-controls="header" aria-selected="true">HEADER</a>
    </li>
    <li class="nav-item">   
        <a class="nav-link" id="object-tab" data-toggle="tab" href="#object" role="tab" aria-controls="object" aria-selected="false">OBJECT OF THE CONTRACT</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="obligations-tab" data-toggle="tab" href="#obligations" role="tab" aria-controls="obligations" aria-selected="false">OBLIGATIONS</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="price-tab" data-toggle="tab" href="#price" role="tab" aria-controls="price" aria-selected="false">PRICE AND DELIVERY DATES</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="termination-tab" data-toggle="tab" href="#termination" role="tab" aria-controls="termination" aria-selected="false">TERMINATION OF THE AGREEMENT</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    {{-- Header Tab --}}
    <div class="tab-pane fade show active" id="header" role="tabpanel" aria-labelledby="header-tab">
        <div class="row my-5">
            <div class="form-group col-md-6">
                {{Form::label('company', 'Company Name:')}}
                {{Form::text('company',null,['class' => 'form-control'])}}
            </div>
            <div class="col-md-6"></div>
            <div class="form-group col-md-6">
                {{Form::label('owner', 'Owner of the company:')}}
                {{Form::text('owner',null,['class' => 'form-control'])}}
            </div>
        </div>
    </div>
    {{-- ./Header Tab --}}

    {{--  Object Tab  --}}
    <div class="tab-pane fade" id="object" role="tabpanel" aria-labelledby="object-tab">
        <div class="row my-5">
            <div class="form-group col-md-6">
                {{Form::label('object', 'Object of the contract:')}}
                {{Form::text('object',null,['class' => 'form-control'])}}
            </div>
        </div>
    </div>
    {{--  ./Object Tab  --}}
    {{--  Obligations Tab  --}}
    <div class="tab-pane fade" id="obligations" role="tabpanel" aria-labelledby="obligations-tab">
        <div class="row my-5" data-members="1">
            <div class="col-md-12 mb-5">
                {{Form::label('members', 'Team Members:')}}
            </div>
            <div class="team col-md-12">
            @include('proposals.team')
            </div>
        </div>
    </div>
    {{--  ./Obligations Tab  --}}
    {{--  Price Tab  --}}
    <div class="tab-pane fade" id="price" role="tabpanel" aria-labelledby="price-tab">
        <div class="row my-5" data-milestones="1">
            <div class="form-group col-md-6">
                {{Form::label('name', 'Project name:')}}
                {{Form::text('name',null,['class' => 'form-control'])}}
            </div>
            <div class="col-md-6"></div>
            <div class="form-group col-md-6">
                {{Form::label('webdev', 'Web Development:')}}
                {{Form::text('webdev',null,['class' => 'form-control'])}}
            </div>
            <div class="col-md-6"></div>
            <div class="form-group col-md-6">
                {{Form::label('timeline', 'Timeline:')}}
                {{Form::text('timeline',null,['class' => 'form-control'])}}
            </div>
            <div class="col-md-12 mb-3">
                {{Form::label('milestones', 'Milestones:')}}
            </div>
            <div class="milestones col-md-12 ">
                @include('proposals.milestones')
            </div>
        </div>
    </div>
    {{--  ./Price Tab  --}}
    {{--  Termination Tab  --}}
    <div class="tab-pane fade" id="termination" role="tabpanel" aria-labelledby="termination-tab">
        <div class="row my-5">
            <div class="form-group col-md-6">
                {{Form::label('lenght', 'Contract time:')}}
                {{Form::text('lenght',null,['class' => 'form-control'])}}
            </div>
            <div class="col-md-6"></div>
            <div class="form-group col-md-6">
                {{Form::label('date', 'Contract printing date:')}}
                {{Form::text('date',null,['class' => 'form-control'])}}
            </div>
        </div>
    </div>
    {{--  ./Termination  Tab  --}}
</div>  