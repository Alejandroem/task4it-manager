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
    public function index()
    {
        //
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
            'name'=>'required'
        ]);
        $requirement = RequirementName::create([
            'name'=>$request->name
        ]);

        if($request->ajax()){
            return response()->json([
                'id'=>$requirement->id,
                'name'=>$requirement->name
            ],201);
        }
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
    public function destroy(RequirementName $requirementName)
    {
        //
    }
}
