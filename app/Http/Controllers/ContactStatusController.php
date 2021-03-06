<?php

namespace App\Http\Controllers;

use App\ContactStatus;
use Illuminate\Http\Request;

class ContactStatusController extends Controller
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
        return view('status.create');
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
            'name'=>'required|unique:contact_statuses',
            'font_color'=>'required',
            'background_color'=>'required'
        ]);

        ContactStatus::create([
            'background_color'=>$request->background_color,
            'font_color'=>$request->font_color,
            'name'=>$request->name
        ]);
        //return back();
        return redirect()->route('catalogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContactStatus  $contactStatus
     * @return \Illuminate\Http\Response
     */
    public function show(ContactStatus $contactStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContactStatus  $contactStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactStatus $contactStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContactStatus  $contactStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactStatus $contactStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactStatus  $contactStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactStatus $status)
    {
        //
        $status->delete();
        return back();
    }
}
