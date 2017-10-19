<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

}
