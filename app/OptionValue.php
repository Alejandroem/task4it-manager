<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jasekz\Laradrop\Models\File;
class OptionValue extends Model
{
    //
    public $timestamps = true;
    protected $guarded = [];

    public function image(){
        return File::where('relation_id',$this->id)
            ->where('relation','option-value')
            ->first();
    }
}
