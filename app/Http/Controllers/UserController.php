<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Auth;
class UserController extends Controller
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
        if (Auth::user()->hasRole('admin')) {
            $users = User::all();
        }else{
            $users = User::whereHas('roles',function($q){
                $q->where('level','>',Auth::user()->roles->first()->level);
            })->get();
        }
        return view('users.index')->with(compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = new User();
        
        if (Auth::user()->hasRole('admin')) {
            $roles = Role::all()->pluck('display_name', 'name');
        } elseif (Auth::user()->hasRole('project-manager')) {
            $roles = Role::where('level', '>', Auth::user()->roles->first()->level)
            ->pluck('display_name', 'name');
        }
    
        return view('users.create')->with(compact('user','roles'));
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
            'username' => 'required|max:50',
            'email' => 'required',
            'password' => 'required',
            'role'=>'required'
        ]);

        $user = User::create([
            'name'=> $request->username,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);
        
        $user->assignRole($request->role);
        if($request->role=='client'){
            $user->givePermissionTo('create');
        }

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //

        return view('users.show')->with(compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        if($request->has('password')&&$request->has('superuser')){
            if(Auth::user()->email  == config('app.super_user')){
                $user->password = bcrypt($request->password);
                $user->save();
            }
        }
        if($request->ajax()){
            return response()->json([
                'user'=>$user,
            ],200);
        }
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        
        if($user->email==config('app.super_user')){
            return back();
        }
        $user->delete();
        return back();
    }

    public function endis(User $user, Request $request){
        $request->validate([
            'value'=>'required'
        ]);
        if($request->value){
            $user->givePermissionTo('create');
        }else{
            $user->revokePermissionTo('create');
        }
        return back();
    }
}
