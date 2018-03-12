<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
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
        $string = $this->requirement->type ==="bugs"? "bug": "requirement";
        foreach ($this->requirement->project->users as $user){
            if($user->id == Auth::id()){
                continue;
            }
            Notification::create([
                'title'=>"New question added!!!",
                'message'=>"New question added on ".$string." ".$this->requirement->title,
                'priority'=>1,
                'user_id'=>$user->id,
                'asset'=>'question',
                'relation'=>'requirement',
                'relation_id'=>$this->requirement->id
            ]);
        }
        Notification::create([
            'title'=>"New question added!!!",
                'message'=>"New question added on ".$string." ".$this->requirement->title,
            'priority'=>1,
            'user_id'=>1,
            'asset'=>'question',
            'relation'=>'requirement',
            'relation_id'=>$this->requirement->id
        ]);
        /* foreach ($this->requirement->project->users as $user){
            Notification::create([
                'title'=>"New question added on ".$string." ".$this->requirement->title,
                'message'=>"1",
                'priority'=>1,
                'user_id'=>$user->id,
                'asset'=>'question',
                'relation'=>'questions',
                'relation_id'=>$this->id
            ]);
        }
        Notification::create([
            'title'=>"New question added on ".$string." ".$this->requirement->title,
            'message'=>"1",
            'priority'=>1,
            'user_id'=>1,
            'asset'=>'question',
            'relation'=>'questions',
            'relation_id'=>$this->id
        ]); */
    }

}
