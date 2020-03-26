<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseAction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='case_action';

  /*
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];


    public function stage()
    {
    return $this->belongsTo('App\Stage','action_stage_id');
    }
    public function stageaction()
    {
    return $this->belongsTo('App\StageAction','stage_action');
    }
    public function cases()
    {
    return $this->belongsTo('App\Cases','case_id');
    }

    public function action()
    {
    return $this->belongsTo('App\Action','action_id');
    }

}
