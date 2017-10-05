<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    //
    public $timestamps = true;
    
    protected $fillable = ['title','description','priority','due_to'];

    public function project(){
        return $this->belongsTo('App\Project');
    }
}
