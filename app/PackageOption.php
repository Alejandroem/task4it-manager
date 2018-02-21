<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageOption extends Model
{
    //
    public $timestamps = true;
    protected $guarded = [];

    public function values(){
        return $this->hasMany('App\OptionValue');
    }

}
