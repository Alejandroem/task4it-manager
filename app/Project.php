<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = ['name','description','budget'];
    public $timestamps = true;

    public function users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function milestones(){
        return $this->hasMany('App\Milestone');
    }
}
