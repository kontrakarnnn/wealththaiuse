<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Case_log extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='case_log';

  /*
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
    public function cases()
    {
    return $this->belongsTo('App\Cases','case_id');
    }

    public function movefromstage()
    {
    return $this->belongsTo('App\Stage','move_from_stage');
    }
    public function movetostage()
    {
    return $this->belongsTo('App\Stage','move_to_stage');
    }
    public function path()
    {
    return $this->belongsTo('App\Path','moving_path');
    }
    public function pathcondition()
    {
    return $this->belongsTo('App\Path_condition','condition_match');
    }

}
