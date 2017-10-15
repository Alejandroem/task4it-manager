@extends('layout.app')
@section('content')
<div class="laradrop" 
    laradrop-file-source="{{ route('files.index',['relation'=>'projects','relation_id'=>$project->id]) }}" 
    {{--laradrop-upload-handler="{{ route('files.store') }}"
    laradrop-file-delete-handler="{{ route('files.destroy', 0) }}"
    laradrop-file-create-handler="{{ route('files.create') }}"  --}}
    laradrop-csrf-token="{{ csrf_token() }}"
    >
    <form class="custom-data">
        <input  type="text" name="relation" id="relation" value="projects" hidden>
        <input  type="text" name="relation_id" id="relation_id" value="{{$project->id}}" hidden>
    </form>
</div>
@endsection