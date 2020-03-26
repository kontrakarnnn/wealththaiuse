<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_auth extends Model
{
    protected $table = 'user_auths';
    protected $fillable = [
      'user_id','structure_id','block_id','description'];

      public function user()
   {
       return $this->belongsTo('App\User','user_id');
   }
   public function block()
{
    return $this->belongsTo('App\Block','block_id');
}
}
