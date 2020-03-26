<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Member_group extends Model
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
    protected $table = 'member_groups';
    protected $guarded = [];


}
