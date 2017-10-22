<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    public $timestamps = true;
    
    protected $guarded = [];

    protected $appends = ['type'];
    
    protected $dates = [
        'created_at',
        'updated_at',
        'last_seen'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getTypeAttribute(){
        switch($this->priority){
            case 0:
                return "alert-primary";
            case 1:
                return "alert-success";
            case 2:
                return "alert-danger";
            case 3:
                return "alert-warning";
        }
    }
}
