<?php

namespace App;
use Jasekz\Laradrop\Models\File;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //
    protected $guarded = [];

    public function file(){
        return File::where('relation_id',$this->id)
            ->where('relation','invoice')
            ->first();
    }

}
