<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='promotion';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];



}
