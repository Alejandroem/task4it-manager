@extends('layout.app')
@section('content')

    <a class="btn btn-primary" href="{{route('home')}}">Return</a>
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">{{ $user->name }}</h4>
        <p class="card-text">{{$user->email}}</p>
    </div>
    </div>
    <form action="{{ route('files.store',['relation'=>'avatar','relation_id'=>Auth::id()]) }}"class="custom-data" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="file" name="file" id="file">

        <button type="submit">Update profile picture</button>
    </form>

    {{--  @include('layout.partials.file-manager',['relation'=>'avatar','id'=>Auth::id()])  --}}
@endsection