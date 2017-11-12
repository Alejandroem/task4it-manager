@extends('layout.app')
@section('content')
    <div class="card">
    <div class="card-body">
        <a class="btn btn-primary pull-right" href="{{route('projects.index')}}">Return</a>
        <h4 class="card-title">{{ $project->name }}</h4>
        <p class="card-text">{{$project->description}}</p>
    </div>
    </div>

    @include('layout.partials.file-manager',['relation'=>'projects','id'=>$project->id])
@endsection