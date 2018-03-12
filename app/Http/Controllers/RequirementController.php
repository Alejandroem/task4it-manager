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
            $requirements = Requirement::where('type','=',$request->type);
            
            if($request->has('project_sel') && $request->project_sel !== null){
                $requirements->where('project_id','=',$request->project_sel);
            }
            $requirements = $requirements->get();
            $projects = Project::pluck('name','id');
        }
        else
        {
            $projects = Auth::user()->projects->pluck('id');

            $requirements = Requirement::where('type','=',$request->type)
            ->whereIn('project_id',$projects)->get();

            $projects = Auth::user()->projects()->whereHas('requirements',function($q)use($request){
                $q->where('type','=',$request->type);
                if($request->has('project_sel')&&$request->project_sel !== null){
                    $q->where('project_id','=',$request->project_sel);
                }
            })->pluck('name','id');
        }
        $text = $request->type;
        $project_sel = $request->project_sel;
        return view('requirements.index')->with(compact('requirements','text','project_sel','projects'));
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
        $project_sel = $request->project_sel;
        if(Auth::user()->hasRole('admin'))
        {   
            $projects = Project::all()->pluck('name','id');            
        }
        else
        {
            $uprojects = Auth::user()->projects->pluck('id');
            $projects = Project::whereIn('id',$uprojects)->get()->pluck('name','id');
        }
        
        return view('requirements.create')->with(compact('requirement','text','project_sel','projects'));
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
        return redirect()->route('requirements.index',['type'=>$request->type,'project_sel'=>$request->project_sel]);
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
        $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
        if(!$pageWasRefreshed ) {
             $requirement->markReadFilesNotifications();
        }    
        $type = $request->type;
        $project_sel =$request->project_sel;
        return view ('requirements.show')->with(compact('requirement','type','project_sel'));
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
            'rate'=>'required|min:0'
        ]);
        if($requirement->status == 5){
            $requirement->status =1;
        }
        $requirement->rate = $request->rate;
        $requirement->percentage = $request->rate * 2 ; 
        $requirement->save();
        return redirect()->route('requirements.index',['type'=>$request->type,'project_sel'=>$request->project_sel]);
    }

    public function updatePercentage(Request $request, Requirement $requirement)
    {
        $request->validate([
            'percentage'=>'required'
        ]);
        if($requirement->statussatus == 5){
            $requirement->status =1;
        }
        $requirement->percentage = $request->percentage;
        $requirement->save();
        return redirect()->route('requirements.index',['type'=>$request->type,'project_sel'=>$request->project_sel]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requirement  $requirement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requirement $requirement, Request $request)
    {
        //
        $requirement->delete();
        return redirect()->route('requirements.index',['type'=>$request->type,'project_sel'=>$request->project_sel]);        

    }
    
    public function changeStatus(Requirement $requirement, Request $request){
        $request->validate([
            'status'=>'required',
            'type'=>'required'
        ]);

        if($request->status==2){
            $user = Auth::user();
            $user->balance += $requirement->rate;
            $user->save();
        }
        if($request->status==5){
            $requirement->rate = null;
            $requirement->percentage = null;
            $requirement->save();
        }
            
        $requirement->status = $request->status;
        $requirement->save();
        if($request->has('type') && $request->type =="json"){
            return response()->json([
                'status' => 'success',
                'data'=>json_encode($requirement)
            ]);
        }
        return redirect()->route('requirements.index',['type'=>$request->type,'project_sel'=>$request->project_sel]);

    }
}
