<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
{
    //
    protected $guarded = [];
    protected $dates = [
        'created_at',
        'updated_at',
        'started_at',
        'ended_at'
    ];


    public function user(){
        return $this->belongsTo('\App\User','user_id');
    }
}
