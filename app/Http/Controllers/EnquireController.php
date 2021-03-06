<?php

namespace App\Http\Controllers;

use App\Enquire;
use App\EnquireOptions;
use App\PackageOption;
use App\OptionValue;
use Alert;
use Illuminate\Http\Request;

class EnquireController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $enquires = Enquire::all();
        return view('enquires.index')->with(compact('enquires'));
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
        // dd($request->input());
        $this->validate($request,[
            'package'=>'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'option'=>'required',
            'email'=>'required'
        ]);
        $enquire = Enquire::create([
            'first_name'=> $request->first_name,
            'last_name'=> $request->last_name,
            'email'=> $request->email,
        ]);
        foreach($request->option as $key => $optionValue){
            $option = PackageOption::find($key);

            foreach($optionValue as $key => $slug){
                $value = OptionValue::find($slug);
                $enquireOption = EnquireOptions::create([
                    'enquire_id'=>$enquire->id,
                    'option_id'=>$option->id,
                    'option_value_id'=>$value->id,
                    'current_option_subject'=>$option->subject,
                    'current_option_value'=>$value->value
                ]);         
            }
        }
        Alert::success('Thank you for your message, we will contact you soon!!')->persistent("Close");        ;

        return redirect()->route('packages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Enquire  $enquire
     * @return \Illuminate\Http\Response
     */
    public function show(Enquire $enquire)
    {
        //
        return view('enquires.show')->with(compact('enquire'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Enquire  $enquire
     * @return \Illuminate\Http\Response
     */
    public function edit(Enquire $enquire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Enquire  $enquire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enquire $enquire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Enquire  $enquire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enquire $enquire)
    {
        //
        $enquire->delete();
        return back();
    }
}
