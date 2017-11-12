@if($questions!=null)
    <div class="col-md-12">
    @foreach($questions as $question)
    <div class="card">
        <div class="card-body">
            <p style="font-size:13px">{{$question->content}}@include('requirements.questions.modal')</p>
            <div class="blockquote-footer">
                {{$question->user->name}}
                <cite title="{{$question->user->email}}"> at {{$question->created_at->toDateTimeString()}}</cite> 
            </div>
        </div>
    </div>
        @include('requirements.questions.thread', ['questions' => $question->questions])
    @endforeach
    </div>
@endif
