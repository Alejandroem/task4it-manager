<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;
use App\Requirement;
use Jasekz\Laradrop\Models\File;
class Payment extends Model
{
    //
    public $timestamps = true;

    protected $guarded = [];

    protected $appends = [/* 'assetName', */'attachment'];

    
  /*   public function getAssetNameAttribute()
    {
        switch($this->asset){
            case "project":
                return Project::where('id',$this->asset_id)->first()->name;
            break;
            case "requirement":
            case "bug":
                return Requirement::where('id',$this->asset_id)->where('type',$this->asset)->first()->title;
            break;
        }
    }
 */
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getAttachmentAttribute(){
        return File::where('relation','payment')->where('relation_id',$this->id)->first();
    }
}
