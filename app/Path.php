<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Path extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='path';


    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];


public function fromstage()
{
return $this->belongsTo('App\Stage','from_stage');
}
public function tostage()
{
return $this->belongsTo('App\Stage','to_stage');
}
}
