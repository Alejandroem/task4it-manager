<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Jasekz\Laradrop\Models\File;
use App\Project;
use App\Requirement;
use App\Payment;
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $timestamps =true;

    protected $dates = [
        'last_login',
        'created_at',
        'updated_at'
    ];

    protected $appends = ['newNotifications'];
    

    public function projects(){
        return $this->belongsToMany('App\Project')->withTimestamps();
    }

    public function files(){
        return $this->hasMany(File::class,'relation_id');
    }

    public function notifications(){
        return $this->hasMany('App\Notification');
    }

    public function getNewNotificationsAttribute(){
        return $this->notifications()->where('last_seen',null)->where('asset',null)->get();
    }
}
