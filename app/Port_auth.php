<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Port_auth extends Model
{
    protected $table = 'port_auths';
    protected $fillable = [
      'member_id','port_id','description'];


}
