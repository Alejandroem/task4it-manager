@extends('layout.app')
@section('content')
    <a class="btn btn-primary" href="{{route('projects.index')}}">Return</a>
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">{{ $project->name }}</h4>
        <p class="card-text">{{$project->description}}</p>
    </div>
    </div>

    @include('layout.partials.file-manager',['relation'=>'projects','id'=>$project->id])
@endsection