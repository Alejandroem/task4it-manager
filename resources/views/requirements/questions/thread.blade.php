@if($questions!=null)
    <div class="col-md-12">
    @foreach($questions as $question)
    <div class="card">
        <div class="card-body">
            <blockquote class="blockquote mb-0">
            <p>{{$question->content}}</p>
            <footer class="blockquote-footer">{{$question->user->name}}<cite title="{{$question->user->email}}"> at {{$question->created_at->toDateTimeString()}}</cite></footer>
            </blockquote>
            <a href="{{route('requirements.questions.create',['requirement'=>$requirement->id,'question_id'=>$question->id])}}" class="btn btn-primary pull-right"><i class="fa fa-commenting-o fa-lg" aria-hidden="true"></i></a>
        </div>
    </div>
        @include('requirements.questions.thread', ['questions' => $question->questions])
    @endforeach
    </div>
@endif