<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionCategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='action_category';

  /*
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];


}
