<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquire extends Model
{
    //
    public $timestamps = true;
    protected $guarded = [];

    public function options(){
        return $this->hasMany('\App\EnquireOptions');
    }

    public function amount(){
        return $this->options->sum('current_option_value');
    }

}
