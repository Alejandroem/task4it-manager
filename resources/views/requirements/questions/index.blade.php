@extends('layout.app')

@section('content')
<a class="btn btn-primary" href="{{route($requirement->type.'.index',['type'=>$requirement->type,'project_sel'=>$project_sel])}}">Return</a>
<a class="btn btn-primary" href="{{route('requirements.questions.create',['requirement'=>$requirement->id])}}">Create</a>
<div class="card">
  <div class="card-body">
    <h4 class="card-title">{{ $requirement->title }}</h4>
    <h6 class="card-subtitle mb-2 text-muted">{{$requirement->project->name}} </h6>
    <p class="card-text">{{$requirement->description}}</p>
  </div>
</div>
    <div class="row" style="font-family:'SourceCodePro-Medium', ＭＳ ゴシック, 'MS Gothic', monospace">
        @include('requirements.questions.thread')
    </div>
@stop
