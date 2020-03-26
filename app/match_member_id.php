<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class match_member_id extends Model
{
      protected $table = 'match_member_groups';
      protected $guarded = [];

      public function noti() {
    return $this->belongsToMany(Noti::class, 'sender_id', 'recieve_id', 'proficiency_id');
 }
}
