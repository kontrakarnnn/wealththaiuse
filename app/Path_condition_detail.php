<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Path_condition_detail extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='path_condition_detail';

  /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];


public function condition()
{
return $this->belongsTo('App\Condition','condition_id');
}
}
