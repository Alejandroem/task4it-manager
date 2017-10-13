<?php

namespace App\Http\Controllers;

use App\Milestone;
use App\Project;
use Illuminate\Http\Request;
use Carbon\Carbon;
class MilestoneController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin']);        
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        //
        return view ('projects.milestones.index')->with(compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        //
        $error_code = 5;
        return redirect()->back()->with('error_code', ['id'=>$project->id,'name'=>$project->name]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Project $project, Request $request)
    {
        //
        $request->validate([
            'dates'=>'required',
            'percentages'=>'required'
        ]);
        $merged = array_combine($request->percentages, $request->dates);
        foreach($merged as $key => $value)
        {
            Milestone::create([
                'project_id'=>$project->id,
                'percentage'=>(float)$key,
                'due_to'=>Carbon::createFromFormat('m/d/Y', $value)->format('Y-m-d')
            ]);
        }
        $projects = Project::all();
        return view('projects.index')->with(compact('projects'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function show(Milestone $milestone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function edit(Milestone $milestone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Milestone $milestone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Milestone  $milestone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Milestone $milestone)
    {
        //
    }
}
