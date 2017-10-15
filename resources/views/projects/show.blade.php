@extends('layout.app')
@section('content')
    @include('layout.partials.file-manager',['relation'=>'projects','id'=>$project->id])
@endsection