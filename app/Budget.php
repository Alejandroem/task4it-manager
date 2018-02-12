<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    //
    protected $fillable = ['name','description','budget','requirements'];
    public $timestamps = true;


    public function project(){
        return $this->hasOne('App\Project','id','project_id');
    }

    public function requirements()
    {
        return $this->belongsToMany('App\RequirementName', 'budget_requirements', 
        'budget_id', 'requirement_id')->withPivot('rate')->withTimestamps();
    }
}
