<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $guarded=[];

    public function requirement(){
        return $this->belongsTo('App\Requirement');
    }

    public function questions(){
        return $this->hasMany('App\Question');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function parent(){
        return $this->belongsTO('App\Question');
    }

    public function notify(){
        foreach ($this->requirement->project->users as $user){
            Notification::create([
                'title'=>"New question added",
                'message'=>"1",
                'priority'=>1,
                'user_id'=>$user->id,
                'asset'=>'question',
                'relation'=>'questions',
                'relation_id'=>$this->id
            ]);
        }
        Notification::create([
            'title'=>"New question added",
            'message'=>"1",
            'priority'=>1,
            'user_id'=>1,
            'asset'=>'question',
            'relation'=>'questions',
            'relation_id'=>$this->id
        ]);
    }

}
