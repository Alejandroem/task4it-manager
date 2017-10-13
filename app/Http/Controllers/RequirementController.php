<?php

namespace App\Http\Controllers;

use App\Requirement;
use App\Project;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
class RequirementController extends Controller
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
    public function index(Request $request)
    {
        //
        if(Auth::user()->hasRole('admin'))
        {   
            $requirements = Requirement::where('type','=',$request->type)->get();
        }
        else
        {
            $projects = Auth::user()->projects->pluck('id');
            $requirements = Requirement::where('type','=',$request->type)
            ->whereIn('project_id',$projects)->get();
        }
        $text = $request->type;
        return view('requirements.index')->with(compact('requirements','text'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $requirement = new Requirement();
        $text = $request->type;
        $projects = Project::all()->pluck('name','id');
        return view('requirements.create')->with(compact('requirement','text','projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'project'=>'required',
            'type'=>'required',
            'title' => 'required|max:50',
            'description' => 'required',
            'priority' => 'required',
            'due_to' => 'required',
        ]);
        Requirement::create([
            'type'=>$request->type,
            'project_id'=>$request->project,
            'user_id'=>Auth::user()->id,
            'type'=>$request->type,
            'title'=>$request->title,
            'description'=>$request->description,
            'priority'=>$request->priority,
            'due_to'=>Carbon::createFromFormat('m/d/Y', $request->due_to)->format('Y-m-d')
        ]);
        return redirect()->route('requirements.index',['type'=>$request->type]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function show(Requirement $requirement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function edit(Requirement $requirement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Requirement $requirement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requirement $requirement)
    {
        //
    }
}
