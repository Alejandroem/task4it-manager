<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    //
    public $timestamps = true;
    protected $guarded = [];

    public function options(){
        return $this->hasMany('App\PackageOption');
    }

}
