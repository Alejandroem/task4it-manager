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
        
        if(Auth::user()->hasRole('admin'))
        {   
            $projects = Project::all()->pluck('name','id');            
        }
        else
        {
            $uprojects = Auth::user()->projects->pluck('id');
            $projects = Project::whereIn('id',$uprojects)->get()->pluck('name','id');
        }
        
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
    public function show(Request $request, Requirement $requirement)
    {
        //
        $type = $request->type;
        return view ('requirements.show')->with(compact('requirement','type'));
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

    public function updateRate(Request $request, Requirement $requirement)
    {
        $request->validate([
            'rate'=>'required'
        ]);
        $requirement->rate = $request->rate;
        $requirement->save();
        return redirect()->route('requirements.index',['type'=>$request->type]);
    }

    public function updatePercentage(Request $request, Requirement $requirement)
    {
        $request->validate([
            'percentage'=>'required'
        ]);
        $requirement->percentage = $request->percentage;
        $requirement->save();
        return redirect()->route('requirements.index',['type'=>$request->type]);
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
    
    public function changeStatus(Requirement $requirement, Request $request){
        $request->validate([
            'status'=>'required',
            'type'=>'required'
        ]);

        if($request->status==2){
            $user = Auth::user();
            $user->balance += $requirement->rate*($requirement->percentage/100) + $requirement->rate;
            $user->save();
        }
            
        $requirement->status = $request->status;
        $requirement->save();
        if($request->has('type') && $request->type =="json"){
            return response()->json([
                'status' => 'success',
                'data'=>json_encode($requirement)
            ]);
        }
        return redirect()->route('requirements.index',['type'=>$request->type]);

    }
}
