<?php

namespace App\Http\Controllers;

use App\Requirement;
use Illuminate\Http\Request;

class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->has('type') && $request->type=="requirements"){
            $requirements = Requirement::all();
            $text = "requirements";
        }
        else if($request->has('type') && $request->type=="bugs"){
            $requirements = Requirement::all();
            $text = "bugs";
        }
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
        return view('requirements.create')->with(compact('requirement','text'));
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
            'type'=>'required',
            'title' => 'required|max:50',
            'description' => 'required',
            'priority' => 'required',
            'due_to' => 'required',
        ]);
        Requirement::create([
            'type'=>$request->type,
            'title'=>$request->title,
            'description'=>$request->description,
            'priority'=>$request->priority,
            'due_to'=>$request->due_to
        ]);

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
