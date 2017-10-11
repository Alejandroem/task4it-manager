@extends('layout.app')
@section('content')

<!-- DataTables Card-->
<div class="row">
    <div class="col-md-4">
        <a class="btn btn-primary" href="{{route('projects.index')}}">Return </a>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        {{ $project ->name }}
    </div>
    <div class="card-body">
        <div class="container">
            <div class="page-header">
                <h1 id="timeline">Milestones</h1>
            </div>
            <ul class="timeline">
                @foreach($project->milestones as $milestone)
                    <li @if($loop->index % 2 != 0) class="timeline-inverted" @endif >
                    <div class="timeline-badge @if($milestone->due_to->diffInDays(null,false)>0) info @elseif($milestone->due_to->diffInDays(null,false)>-4 && $milestone->due_to->diffInDays(null,false) < 0  ) danger @endif">@if($milestone->due_to->diffInDays(null,false)>0)<i class="fa fa-check"></i>@endif</div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                        <h4 class="timeline-title">% {{number_format($milestone->percentage)}} represents $ {{ number_format($project->budget * ($milestone->percentage/100),2)}}</h4>
                        <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>Due to: {{ $milestone->due_to->toFormattedDateString() }}</small></p>
                        </div>
                        {{--  <div class="timeline-body">
                        <p>
                            Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo.
                            Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.
                        </p>
                        </div>  --}}
                    </div>
                    </li>
                @endforeach
            </ul>
            </div>
    </div>
    {{--<div class="card-footer small text-muted">Updated today at 11:59 PM</div> --}}
</div>
@stop