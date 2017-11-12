@extends('layout.app')
@section('content')
    <a class="btn btn-primary" href="{{route('requirements.index',['type'=>$type])}}">Return</a>
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">{{ $requirement->name }}</h4>
        <p class="card-text">{{$requirement->description}}</p>
    </div>
    </div>

    @include('layout.partials.file-manager',['relation'=>'requirement','id'=>$requirement->id])
@endsection