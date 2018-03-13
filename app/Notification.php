<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Requirement;
use App\Project;
use App\Question;
class Notification extends Model
{
    //
    public $timestamps = true;
    
    protected $guarded = [];

    protected $appends = ['type','url'];
    
    protected $dates = [
        'created_at',
        'updated_at',
        'last_seen'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getUrlAttribute(){
        switch($this->relation){
            case "requirement":
                $requirement = null;
                if($this->relation=="questions"){
                    $requirement = Question::find($this->relation_id)->requirement;
                }else if($this->relation=="requirement"){
                    $requirement = Requirement::find($this->relation_id);
                }
                if(!$requirement){
                    return "";
                }

                if($this->asset=="file"){
                    return "".route('requirements.show',['requirement'=>$requirement->id,'type'=>$requirement->type,'project_sel'=>""]);
                }else if($this->asset=="question"){
                    return "".route('requirements.questions.index',['requirement'=>$requirement->id]);
                }
                return "".route('requirements.questions.index',['requirement'=>1]);
            case "projects":
                $project = Project::find($this->relation_id);
                if($project){
                   return "".route('projects.show',['id'=>$project->id]);
                }
        }
        
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
