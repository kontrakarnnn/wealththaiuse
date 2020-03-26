<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organize extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'organize';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
}
