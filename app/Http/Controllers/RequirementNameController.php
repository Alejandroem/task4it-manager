<?php

namespace App\Http\Controllers;

use App\RequirementName;
use Illuminate\Http\Request;

class RequirementNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $names = RequirementName::all();
        if($request->ajax()){
            return response()->json([
                'names'=>$names
            ],201);
        }
        return $names;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name'=>'required|unique:requirement_names'
        ]);
        $requirement = RequirementName::create([
            'name'=>$request->name,
            'parent_id'=>$request->parent == -1? null : $request->parent
        ]);

        if($request->ajax()){
            return response()->json([
                'id'=>$requirement->id,
                'name'=>$requirement->name
            ],201);
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RequirementName  $requirementName
     * @return \Illuminate\Http\Response
     */
    public function show(RequirementName $requirementName)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RequirementName  $requirementName
     * @return \Illuminate\Http\Response
     */
    public function edit(RequirementName $requirementName)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RequirementName  $requirementName
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequirementName $requirementName)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RequirementName  $requirementName
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequirementName $name,Request $request)
    {
        //
        $name->delete();
        if($request->ajax()){
            return response()->json([
                'message'=>'success'
            ],201);
        }
        return back();
    }
}
