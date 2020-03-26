<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class User_group extends Model
{


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'user_groups';
    protected $guarded = [];


}
