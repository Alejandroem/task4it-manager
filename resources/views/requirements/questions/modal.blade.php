<!-- Button trigger modal -->
<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#question-{{$question->id}}">
<i class="fa fa-commenting-o fa-lg" aria-hidden="true"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="question-{{$question->id}}" tabindex="-1" role="dialog" aria-labelledby="question-{{$question->id}}ModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="question-{{$question->id}}ModalLabel">{{$question->content}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    {{ Form::open(array('route' => array('requirements.questions.store','requirement'=>$requirement->id),'method'=>'POST')) }}
    {{Form::token()}}
        <div class="modal-body">
        <input type="text" hidden value="{{$question->id}}" name="question" id="question">
            <div class="form-control">
                {{ Form::text('response') }}
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Publish response</button>
        </div>
    {{Form::close()}}
    </form>
    </div>
</div>
</div>