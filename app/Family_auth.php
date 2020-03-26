<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family_auth extends Model
{
    protected $table = 'family_auths';
    protected $fillable = [
      'member_id','family_id','description','status','created_by'];


}
