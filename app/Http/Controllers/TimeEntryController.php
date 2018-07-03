<?php

namespace App\Http\Controllers;

use App\TimeEntry;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
class TimeEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $timeentries = TimeEntry::all();
        return view('timeentries.index')->with(compact('timeentries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $projects = Auth::user()->projects()->pluck('name','id');
        return view('timeentries.create')->with(compact('projects'));
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
            'project_id'=>'required',
            'started_at'=>'required',
            'ended_at'=>'required|after:started_at',
            'hourly_rate'=>'required'
        ]);
        $timeEntry = TimeEntry::create([
            'project_id'=>$request->project_id,
            'started_at'=>Carbon::createFromFormat('m/d/Y H:i', $request->started_at),
            'ended_at'=>Carbon::createFromFormat('m/d/Y H:i', $request->ended_at),
            'hourly_rate'=>$request->hourly_rate,
            'user_id'=>Auth::id()
        ]);
        return redirect()->route('timetracking.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TimeEntry  $timeEntry
     * @return \Illuminate\Http\Response
     */
    public function show(TimeEntry $timeEntry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TimeEntry  $timeEntry
     * @return \Illuminate\Http\Response
     */
    public function edit(TimeEntry $timeEntry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TimeEntry  $timeEntry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TimeEntry $timeEntry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TimeEntry  $timeEntry
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimeEntry $timeEntry)
    {
        //
    }
}
