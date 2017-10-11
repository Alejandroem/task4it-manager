<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    //
    protected $guarded = [];
    public $timestamps = true;
    protected $dates = ['due_to'];
}
