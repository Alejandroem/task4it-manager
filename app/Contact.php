<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $guarded = [];

    public function city(){
        return $this->belongsTo('\App\City','city_id');
    }

    public function status(){
        return $this->belongsTo('\App\ContactStatus','contact_status_id');
    }
    public function contact_type(){
        return $this->belongsTo('\App\ContactType','contact_type_id');
    }
}
