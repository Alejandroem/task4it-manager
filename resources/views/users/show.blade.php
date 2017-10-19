@extends('layout.app')
@section('content')

    
    <div class="card">
    <div class="card-body">
        <a class="btn btn-primary pull-right" href="{{route('home')}}">Return</a>
        <h4 class="card-title">{{ $user->name }}</h4>
        <p class="card-text">{{$user->email}}</p>
    </div>
    </div>
    <hr>
    <h4>Select a new profile image</h4>
    <hr>
    <form action="{{ route('files.store',['relation'=>'avatar','relation_id'=>Auth::id()]) }}" class="col-md-10 col-md-offset-2 form-inline" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            {{csrf_field()}}
            
            <label class="custom-file">
                <input type="file" id="file" name="file" class="custom-file-input" required>
                <span class="custom-file-control"></span>
            </label>

            <button class="btn btn-primary" type="submit">Update profile picture</button>
        </div>
    </form>

    {{--  @include('layout.partials.file-manager',['relation'=>'avatar','id'=>Auth::id()])  --}}
@endsection