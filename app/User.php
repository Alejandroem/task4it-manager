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

    protected $appends = ['balance'];
    

    public function projects(){
        return $this->belongsToMany('App\Project')->withTimestamps();
    }

    public function files(){
        return $this->hasMany(File::class,'relation_id');
    }

    public function getBalanceAttribute()
    {
        $projects = $this->projects()->pluck('id');

        $requirements = Requirement::whereIn('project_id',$projects)->get();
        $balance = 0;
        foreach($requirements as $requirement){
            if($requirement->rate!=null && $requirement->percentage!=null && ($requirement->status ==2 || $requirement->status == 3)){
                $balance+= $requirement->rate;
                $balance+= $requirement->rate * ($requirement->percentage/100);
            }
        }

        $payments = Payment::where('user_id',$this->id)->sum('amount');

        return $balance - $payments;
    }
}
