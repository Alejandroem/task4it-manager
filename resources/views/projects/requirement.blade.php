`<div class="req" data-id="`+(id)+`-`+(children+1)+`" data-parent="`+(id)+`">
    <div class="row">
        <div class="col-md-6">
            {{--  <label for="admin-rate">Select a requirement:</label>  --}}
            <select name="requirements" id="requirements" data-id="`+(id)+`-`+(children+1)+`" class="requirements form-control">
                @foreach($requirements as $key => $requirement)
                    <option value="{{$key}}">{{$requirement}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            {{--  <label for="admin-rate">Rate:</label>  --}}
            <input class="form-control admin-rate" name="admin-rate" id="admin-rate" data-id="`+(id)+`-`+(children+1)+`" type="number" min="0">
        </div>
        <div class="col-md-1">
            {{--  <label for=""></label>  --}}
            <button type="button" class="add my-2 btn btn-primary" id="add-sub" data-id="`+(id)+`-`+(children+1)+`">+</button>
        </div>
        <div class="col-md-1">
            {{--  <label for=""></label>  --}}
            <button type="button" class="del my-2 btn btn-primary" id="del-sub" data-id="`+(id)+`-`+(children+1)+`">-</button>
        </div>
    </div>
    <div class="row" >
        <div class="col-md-1"></div>
        <div class="req-panel col-md-11" data-id="`+(id)+`-`+(children+1)+`" data-children="0">

        </div>
    </div>
</div>`