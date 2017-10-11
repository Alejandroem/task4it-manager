<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
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
    public function index()
    {
        //
        $projects = Project::all();
        return view('projects.index')->with(compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $project = new Project();
        $users = User::all()->pluck('email','id');
        return view('projects.create')->with(compact('project','users'));
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
        $user = null;
        $request->validate([
            'name' => 'required|max:50',
            'description' => 'required',
            'budget'=>'required|numeric|min:0'
        ]);
        if($request->toogle_user==='on'){
            $request->validate([
                'username' => 'required|max:50',
                'email' => 'required',
                'password' => 'required',
            ]);
            $user = User::create([
                'name'=>$request->username,
                'email'=>$request->email,
                'password'=>$request->password
            ]);
        }else{
            $request->validate([
                'user' => 'required'
            ]);
        }
        
        $project = Project::create($request->input());
        if(isset($user) || $user !== null)
        {
            $user->projects()->attach($project->id);
        }
        
        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
        $users = User::whereNotIn('id',$project->users->pluck('id'))
        ->get()
        ->pluck('name','id');
        return view('projects.edit')->with(compact('project','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
        $request->validate([
            'name'=>'required'
        ]);
        
        $project->users()->sync($request->users);
        $project->users()->attach($request->newUsers);
        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }


}
