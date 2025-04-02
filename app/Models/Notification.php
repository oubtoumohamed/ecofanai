<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\MainModel;

class Notification extends Model
{
   use MainModel;
   protected $fillable = ['object','module','module_id','contenu','user_id','creator_id','link','etat','read_at','system','key','start_at'];

   public function __toString(){
        return $this->object;
   }

   public function user(){
    return $this->belongsTo('App\User', 'user_id');
   } 

   public function creator(){
       return $this->belongsTo('App\User', 'creator_id');
   }


   public function toArray(){

      $array = parent::attributesToArray();

      $array['creator'] = $this->creator;
      $array['user'] = $this->user;

      return $array;
   }
}

