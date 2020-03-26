<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member_type extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'member_type';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
}
