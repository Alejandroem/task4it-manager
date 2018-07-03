<form action="{{ route('files.store',['relation'=>$relation,'relation_id'=>$relation_id]) }}" class="col-md-10 col-md-offset-2 form-inline" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        {{csrf_field()}}
        
        <label class="custom-file">
            <input type="file" id="file" name="file" class="custom-file-input" required>
            <span class="custom-file-control"></span>
        </label>
        @if($has_submit_button)
        <button class="btn btn-primary" type="submit">{{$call_to_action_text}}</button>
        @endif
    </div>
</form>