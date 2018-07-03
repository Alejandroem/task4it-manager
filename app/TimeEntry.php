<?php

namespace App;
use App\Project;
use App\User;
use Illuminate\Database\Eloquent\Model;

class TimeEntry extends Model
{
    //
    protected $guarded = [];
    protected $dates = [
        'created_at',
        'updated_at',
        'started_at',
        'ended_at'
    ];

    public function project(){
        return $this->belongsTo('\App\Project','project_id');
    }

    public function user(){
        return $this->belongsTo('\App\User','user_id');
    }
}
