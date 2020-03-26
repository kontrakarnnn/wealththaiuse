<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organize_auth extends Model
{
    protected $table = 'organize_auths';
    protected $fillable = [
      'member_id','organize_id','description','status'];


}
