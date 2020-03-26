<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    public function users()
    {
      return $this->belongsToMany('App\role','user_roles','role_id','user_id');
    }
}
