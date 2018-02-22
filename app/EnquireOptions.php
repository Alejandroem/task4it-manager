<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnquireOptions extends Model
{
    //
    public $timestamps = true;
    protected $guarded = [];

    public function option(){
        return $this->belongsTo('App\PackageOption','option_id');
    }

    public function value(){
        return $this->belongsTo('App\OptionValue','option_value_id');
    }

}
