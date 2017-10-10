<?php

namespace App\Http\Controllers;

use App\Question;
use App\Requirement;
use Illuminate\Http\Request;
use Auth;
class QuestionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Requirement $requirement)
    {
        //
        $questions = $requirement->questions()->whereNull('question_id')->get();
        return view ('requirements.questions.index')->with(compact('requirement','questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Requirement $requirement)
    {
        //
        return view('requirements.questions.create')->with(compact('requirement'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response  
     */
    public function store(Requirement $requirement,Request $request)
    {
        //
        $request->validate([
            'response'=>'required'
        ]);
        
        $newQuestion = Question::create([
            'user_id'=>Auth::id(),
            'requirement_id'=>$requirement->id,
            'content'=>$request->response
        ]);
        if($request->has('question')){
            $question = Question::find($request->question);
            $newQuestion->question_id = $question->id;
            $question->save();
        }
        return redirect()->route('requirements.questions.index',['requirement'=>$requirement->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Requirement $requirement = null, Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Requirement $requirement = null, Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Requirement $requirement = null, Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requirement $requirement = null, Question $question)
    {
        //
    }
}
