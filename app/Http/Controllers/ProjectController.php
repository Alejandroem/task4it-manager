<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Spatie\Permission\Models\Role;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:admin|project-manager|client']);
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
        if (Auth::user()->hasAnyRole('admin|project-manager')) {
            $projects = Project::all();
        } else {
            $projects = Project::whereHas('users', function ($q) {
                $q->where('id', Auth::id());
            })->get();
        }
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
        
        if (Auth::user()->hasRole('admin')) {
            $roles = Role::all()->pluck('display_name', 'name');
        } elseif (Auth::user()->hasRole('project-manager')) {
            $roles = Role::where('level', '>', Auth::user()->roles->first()->level)
            ->pluck('display_name', 'name');
        }
        
        if (Auth::user()->hasRole('admin')) {
            $users = User::all()->pluck('email','id');
        }else{
            $users = User::whereHas('roles',function($q){
                $q->where('level','>',Auth::user()->roles->first()->level);
            })->get()->pluck('email','id');
        }
        return view('projects.create')->with(compact('project', 'users', 'roles'));
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
        if ($request->toogle_user==='on') {
            $request->validate([
                'username' => 'required|max:50',
                'email' => 'required',
                'password' => 'required',
                'role' => 'required',
            ]);
            $user = User::create([
                'name'=>$request->username,
                'email'=>$request->email,
                'password'=>$request->password
            ]);
            $user->assignRole($request->role);
        } else {
            $request->validate([
                'user' => 'required'
            ]);
            $user = User::find($request->user);
        }
        
        $project = Project::create($request->input());
        $user->projects()->attach($project->id);
        
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
        if (Auth::user()->hasRole('admin')) {
            $users = User::all()->pluck('email','id');
        }else{
            $users = User::whereHas('roles',function($q){
                $q->where('level','>',Auth::user()->roles->first()->level);
            })->get()->pluck('email','id');
        }
        if (Auth::user()->hasRole('admin')) {
            $project_users = $project->users->pluck('email','id');
        }else{
            $project_users = $project->users()->whereHas('roles',function($q){
                $q->where('level','>',Auth::user()->roles->first()->level);
            })->get()->pluck('email','id');
        }
        return view('projects.edit')->with(compact('project', 'users','project_users'));
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
