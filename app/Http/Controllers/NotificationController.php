<?php

namespace App\Http\Controllers;

use App\Notification;
use App\User;
use Illuminate\Http\Request;
use Auth, Session;

class NotificationController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:admin|client']);        
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
        $notifications = Notification::all();
        return view('notifications.index')->with(compact('notifications'));
    }

    public function list(User $user){
        $notifications = $user->notifications;
        return view('notifications.list')->with(compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::role('client')->pluck('email','id');
        return view('notifications.create')->with(compact('users'));
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
            'users'=>'required',
            'title'=>'required|max:25',
            'priority'=>'required',
            'message'=>'required|max:50'
        ]);
        
        foreach($request->users as $userid){
            Notification::create([
                'title'=>$request->title,
                'message'=>$request->message,
                'priority'=>$request->priority,
                'user_id'=>$userid
            ]);
        }

        return redirect()->route('notifications.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }

    public function check(Request $request){
        $request->validate([
            'id'=>'required'
        ]);
        if(Auth::user()){
            $notification = Notification::find($request->id);
            $notification->last_seen = \Carbon\Carbon::now();
            $notification->save();
        }
    }
}
