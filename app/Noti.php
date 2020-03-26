<?php

namespace App;
use App\User;
use App\Person;
use Illuminate\Database\Eloquent\Model;

class Noti extends Model
{
  protected $table = 'notis';
  protected $guarded = [];


    public function sender()
 {
     return $this->hasOne('App\Noti', 'sender_id');
 }

   public function receiver()
 {
     return $this->hasOne('App\Noti', 'recieve_id');
 }
}
