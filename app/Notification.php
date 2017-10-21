<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    public $timestamps = true;
    
    protected $guarded = [];
    
    protected $dates = [
        'created_at',
        'updated_at',
        'last_seen'
    ];
}
