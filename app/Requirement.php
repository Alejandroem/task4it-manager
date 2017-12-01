<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Requirement extends Model
{
    //
    public $timestamps = true;
    protected $dates = ['due_to'];
    
    protected $fillable = ['type','project_id','user_id','title','description','priority','due_to'];

    protected $appends = ['total'];
    

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function questions(){
        return $this->hasMany('App\Question');
    }

    public function getTotalAttribute()
    {
        return $this->rate * ($this->percentage/100) + $this->rate;
    }

    public function notify(){
        foreach ($this->project->users as $user){
            Notification::create([
                'title'=>"New file added",
                'message'=>"1",
                'priority'=>1,
                'user_id'=>$user->id,
                'asset'=>'file',
                'relation'=>'requirement',
                'relation_id'=>$this->id
            ]);
        }
        Notification::create([
            'title'=>"New file added",
            'message'=>"1",
            'priority'=>1,
            'user_id'=>1,
            'asset'=>'file',
            'relation'=>'requirement',
            'relation_id'=>$this->id
        ]);
    }
    
    public function newFilesNotifications(\App\User $user = null){
        return Notification::where('relation','requirement')
        ->where('relation_id',$this->id)
        ->where('user_id',isset($user)?$user->id : Auth::id())
        ->where('last_seen',null)
        ->get();
    }


    public function newQuestionsNotifications(\App\User $user = null){
        $questionsId = $this->questions()->pluck('id');
        return Notification::where('relation','questions')
        ->whereIn('relation_id',$questionsId)
        ->where('user_id',isset($user)?$user->id : Auth::id())
        ->where('last_seen',null)
        ->get();
    }

    public function markReadFilesNotifications(\App\User $user = null){
        Notification::where('relation','requirement')
        ->where('relation_id',$this->id)
        ->where('user_id',isset($user)?$user->id : Auth::id())
        ->where('last_seen',null)
        ->delete();
    }
    public function markReadQuestionsNotifications(\App\User $user = null){
        $questionsId = $this->questions()->pluck('id');
        return Notification::where('relation','questions')
        ->whereIn('relation_id',$questionsId)
        ->where('user_id',isset($user)?$user->id : Auth::id())
        ->where('last_seen',null)
        ->delete();
    }

}
