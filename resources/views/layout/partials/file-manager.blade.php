<div class="well col-md-12 ">
<div class="laradrop bootstrap-3" 
    laradrop-file-source="{{ route('files.index',['relation'=>$relation,'relation_id'=>$id]) }}" 
    laradrop-file-create-handler="{{ route('files.createPost',['relation'=>$relation,'relation_id'=>$id]) }}" 
    laradrop-upload-handler="{{ route('laradrop.store') }}"
    laradrop-file-delete-handler="{{ route('laradrop.destroy', 0) }}"
    laradrop-file-create-handler="{{ route('laradrop.create') }}"
    laradrop-csrf-token="{{ csrf_token() }}"
    >
    <form class="custom-data">
        <input  type="text" name="relation" id="relation" value="{{$relation}}" hidden>
        <input  type="text" name="relation_id" id="relation_id" value="{{$id}}" hidden>
    </form>
</div>
</div>