<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\MainModel;

class Bin extends Model
{
   use MainModel;
   protected $fillable = ['code','lat','lon'];

   public function __toString(){
        return $this->code;
   }

}