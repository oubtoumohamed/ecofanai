<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\MainModel;

class Action extends Model
{
   use MainModel;   

   protected $fillable = ['code','state','note','user_id','media_id'];

   public function __toString(){
        return $this->code;
   }

}