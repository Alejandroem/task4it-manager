<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //

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
}
