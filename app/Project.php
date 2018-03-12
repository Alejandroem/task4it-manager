<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notification;
use Auth;
use Debugbar;
class Project extends Model
{
    //
    protected $fillable = ['name','description','budget','requirements'];
    public $timestamps = true;

    public function users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function requirements(){
        return $this->hasMany('App\Requirement');
    }

    public function milestones(){
        return $this->hasMany('App\Milestone');
    }

    public function notify(){
        
        foreach ($this->users as $user){
            if($user->id == Auth::id()){
                continue;
            }
            Notification::create([
                'title'=>"New file added !!",
                'message'=>"New file added on project ".$this->name.".",
                'priority'=>1,
                'user_id'=>$user->id,
                'asset'=>'file',
                'relation'=>'projects',
                'relation_id'=>$this->id
            ]);
        }
        Notification::create([
            'title'=>"New file added!!",
            'message'=>"New file added on project ".$this->name.".",
            'priority'=>1,
            'user_id'=>1,
            'asset'=>'file',
            'relation'=>'projects',
            'relation_id'=>$this->id
        ]);
    }

    public function newFilesNotifications(\App\User $user = null){
        return Notification::where('relation','projects')
        ->where('relation_id',$this->id)
        ->where('user_id',isset($user)?$user->id : Auth::id())
        ->where('last_seen',null)
        ->get();
    }

    public function markReadFilesNotifications(\App\User $user = null){
        Notification::where('relation','projects')
        ->where('relation_id',$this->id)
        ->where('user_id',isset($user)?$user->id : Auth::id())
        ->update([
            'last_seen' => \Carbon\Carbon::now()
        ]);
    }
}
