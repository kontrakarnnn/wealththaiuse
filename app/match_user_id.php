<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class match_user_id extends Model
{
      protected $table = 'match_user_groups';
      protected $guarded = [];

      public function noti() {
    return $this->belongsToMany(Noti::class, 'sender_id', 'recieve_id', 'proficiency_id');
 }
}
