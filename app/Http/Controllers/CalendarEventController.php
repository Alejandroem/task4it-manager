<?php

namespace App\Http\Controllers;

use App\CalendarEvent;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
class CalendarEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::user()->hasAnyRole('admin')){
            $tasks = CalendarEvent::all();

        }else{
            $tasks = CalendarEvent::where('user_id',Auth::id())->get();            
        }
                
        return view('calendar.index')->with(compact('tasks'));
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
        return view('calendar.create')->with(compact('projects'));
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
            'description'=>'required',
            'started_at'=>'required',
            'ended_at'=>'required|after:started_at',
        ]);
        $timeEntry = CalendarEvent::create([
            'description'=>$request->description,
            'started_at'=>Carbon::createFromFormat('m/d/Y H:i', $request->started_at),
            'ended_at'=>Carbon::createFromFormat('m/d/Y H:i', $request->ended_at),
            'user_id'=>Auth::id()
        ]);
        return redirect()->route('calendar.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CalendarEvent  $calendarEvent
     * @return \Illuminate\Http\Response
     */
    public function show(CalendarEvent $calendarEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CalendarEvent  $calendarEvent
     * @return \Illuminate\Http\Response
     */
    public function edit(CalendarEvent $calendarEvent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CalendarEvent  $calendarEvent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CalendarEvent $calendarEvent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CalendarEvent  $calendarEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(CalendarEvent $calendar)
    {
        //
        $calendar->delete();
        return redirect()->back();
    }
}
