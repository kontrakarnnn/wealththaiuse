<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='action_type';

  /*
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];
    public function actioncategory()
    {
    return $this->belongsTo('App\ActionCategory','cat_id');
    }

}
