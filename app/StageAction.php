<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StageAction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='stage_action';

  /*
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];


    public function stage()
    {
    return $this->belongsTo('App\Stage','current_stage_id');
    }

    public function action()
    {
    return $this->belongsTo('App\Action','action_id');
    }

}
