<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;
use Debugbar;
class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $packages = Package::all();
        return view('packages.index')->with(compact('packages'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $packages = Package::all();
        return view('packages.create')->with(compact('packages'));
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
            'name'=>'required'
        ]);

        $package = Package::create([
            'name'=>$request->name
        ]);

        if($request->ajax()){
            return response()->json([
                'id'=>$package->id,
                'name'=>$package->name
            ],201);
        }
        return $package;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
        return view('packages.show')->with(compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package,Request $request)
    {
        //
        Debugbar::info($package);
        if($request->ajax() && $package->delete()){
            return response()->json([
                'message'=>'success'
            ],201);
        }else{
            $package->delete();
        }
        return back();
    }
}
