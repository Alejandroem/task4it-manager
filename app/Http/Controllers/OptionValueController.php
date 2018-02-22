<?php

namespace App\Http\Controllers;

use App\OptionValue;
use Illuminate\Http\Request;
use Debugbar;
class OptionValueController extends Controller
{
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
            'name'=>'required'
        ]);

        $option = OptionValue::create([
            'name'=>$request->name,
            'package_option_id'=>$request->parent,
            'value'=>0
        ]);

        if($request->ajax()){
            return response()->json([
                'id'=>$option->id,
                'name'=>$option->name
            ],201);
        }
        return $option;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OptionValue  $optionValue
     * @return \Illuminate\Http\Response
     */
    public function show(OptionValue $optionValue)
    {
        //
        return "show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OptionValue  $optionValue
     * @return \Illuminate\Http\Response
     */
    public function edit(OptionValue $optionValue)
    {
        //
        return "edit";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OptionValue  $optionValue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OptionValue $value)
    {
        //
        
        $this->validate($request,[
            'new_value'=>'required'
        ]);

        $value->value = $request->new_value;
        if($request->ajax() && $value->save()){
            return response()->json([
                'message'=>'success'
            ],201);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OptionValue  $optionValue
     * @return \Illuminate\Http\Response
     */
    public function destroy(OptionValue $value,Request $request)
    {
        //
        Debugbar::info($value);
        if($request->ajax() && $value->delete()){
            return response()->json([
                'message'=>'success'
            ],201);
        }else{
            $value->delete();
        }
        return back();
    }
}
