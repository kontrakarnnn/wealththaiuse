<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='action';

  /*
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
    public function actiontype()
    {
    return $this->belongsTo('App\ActionType','type_id');
    }

}
