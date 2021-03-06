<?php

namespace App\Http\Controllers;

use App\ContactType;
use Illuminate\Http\Request;

class ContactTypeController extends Controller
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
        return view ('types.create');
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
            'name'=>'required|unique:contact_types'
        ]);

        ContactType::create([
            'name'=>$request->name
        ]);
        //return back();
        return redirect()->route('catalogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContactType  $contactType
     * @return \Illuminate\Http\Response
     */
    public function show(ContactType $contactType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContactType  $contactType
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactType $contactType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContactType  $contactType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactType $contactType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactType  $contactType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactType $type)
    {
        //
        $type->delete();
        return back();
    }
}
