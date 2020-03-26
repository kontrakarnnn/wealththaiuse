<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Case_condition extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table ='case_condition';

  /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    public function cases()
{
    return $this->belongsTo('App\Cases','case_id');
}
public function path_condition_detail()
{
return $this->belongsTo('App\Path_condition_detail','path_condition_detail');
}

}
