<?php

namespace App\Http\Controllers;

use App\Project;
use App\Requirement;
use App\User;
use Illuminate\Http\Request;
use Auth, Purifier;
use Spatie\Permission\Models\Role;
use Debugbar;
class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:admin|project-manager|client|developer']);
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
        if (Auth::user()->hasAnyRole('admin')) {
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

        if (Auth::user()->hasRole('admin')) {
            $project_users = $project->users->pluck('email','id');
        }else{
            $project_users = $project->users()->whereHas('roles',function($q){
                $q->where('level','>=',Auth::user()->roles->first()->level);
            })->get()->pluck('email','id');
        }

        $clients = User::role('client')->pluck('email','id');

        return view('projects.create')->with(compact('project', 'users', 'roles','project_users','clients'));
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
            'budget'=>'required|numeric|min:0',
            'charge_to'=>'required'
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
        
        $project = Project::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'budget'=>$request->budget,
            'requirements'=>$request->has('requirements-list')?$request->get('requirements-list'):""
        ]);
        
        $user->projects()->attach($project->id);
        $client = User::find($request->charge_to);
        $client->balance+=$project->budget;
        $client->save();
        
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
        $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
       if(!$pageWasRefreshed ) {
            $project->markReadFilesNotifications();
       }    
        return view ('projects.show')->with(compact('project'));
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
                $q->where('level','>=',Auth::user()->roles->first()->level);
            })->get()->pluck('email','id');
        }
        if (Auth::user()->hasRole('admin')) {
            $project_users = $project->users->pluck('email','id');
        }else{
            $project_users = $project->users()->whereHas('roles',function($q){
                $q->where('level','>=',Auth::user()->roles->first()->level);
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
            'name'=>'required',
            'description' => 'required',
            'budget'=>'required|numeric|min:0'
        ]);
        
        $project->name = $request->name;
        $project->description=$request->description;
        $project->budget = $request->budget;
        $project->requirements = $request->has('requirements-list')?$request->get('requirements-list'):" ";
        $project->save();

        $project->users()->sync($request->users);
        $project->users()->attach($request->newUsers);
        return redirect()->route('projects.index');
    }

    public function exportRequirements(Request $request){
        Debugbar::info($request->input());
        $request->validate([
            'message'=>'required'
        ]);
        $requirements = json_decode($request->message);
        $total = 0;
        foreach($requirements as $requirement){
            $total+= floatval($requirement->rate);
        }
        Debugbar::info($requirements);f
        $view =  \View::make('pdf.requirements', compact('requirements', 'total'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->download('invoice');
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
        $project->delete();
        return back();
    }
}
