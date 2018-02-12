<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequirementName extends Model
{
    //
    public $timestamps = true;
    protected $guarded = [];


    public function subRequirements(){
        return $this->hasMany('App\RequirementName','parent_id');
    }

    public function parent(){
        return $this->belongsTo('App\RequirementName','parent_id');
    }

}
