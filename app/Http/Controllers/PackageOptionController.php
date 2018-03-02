<?php

namespace App\Http\Controllers;

use App\PackageOption;
use Illuminate\Http\Request;
use Debugbar;
class PackageOptionController extends Controller
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
        return "index";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return "create";
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
        $this->validate($request,[
            'name'=>'required',
            'parent'=> 'required'
        ]);

        $option = PackageOption ::create([
            'subject'=>$request->name,
            'package_id'=>$request->parent
        ]);

        if($request->ajax()){
            return response()->json([
                'id'=>$option->id,
                'name'=>$option->subject
            ],201);
        }
        return $option;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PackageOption  $packageOption
     * @return \Illuminate\Http\Response
     */
    public function show(PackageOption $packageOption)
    {
        //
        return "show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PackageOption  $packageOption
     * @return \Illuminate\Http\Response
     */
    public function edit(PackageOption $packageOption)
    {
        //
        return "edit";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PackageOption  $packageOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PackageOption $option)
    {
        //
        if($request->has('multiple')){
            $option->multiple = $request->multiple;
        }

        if($request->ajax() && $option->save()){
            return response()->json([
                'message'=>'success'
            ],201);
        }else{
            $option->save();
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PackageOption  $packageOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackageOption $option,Request $request)
    {
        //
        
        Debugbar::info($option);
        if($request->ajax() && $option->delete()){
            return response()->json([
                'message'=>'success'
            ],201);
        }else{
            $option->delete();
        }
        return $option;
        return back();
    }
}
